<?php

namespace App\Http\Controllers;

use Str;
use App\Models\Chat;
use App\Models\Visitor;
use Illuminate\Http\Request;

use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\String\Span\Span;

class VisitorController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Visitor;
        }
        return Visitor::where($filter);
    }
    public function getInfo($token = NULL) {
        $visitor = Visitor::where('token', $token)->first();
        return response()->json(['data' => $visitor]);
    }
    public function index() {
        return view('index');
    }
    public function removeUnnecessary($sentences) {
        $toRemove = config('wordbank')['unnecessary'];
        return array_diff($sentences, $toRemove);
    }
    public function introduction(Request $request) {
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();
        $sentence = $request->text;
        $stemmedSentence = $stemmer->stem($sentence);

        
        $sentences = explode(" ", $stemmedSentence);
        $name = $this->removeUnnecessary($sentences);
        $name = $this->removeConjunction($name);
        $name = array_diff($name, ["nama"]);

        $name = ucwords(implode(" ", $name));
        $token = Str::random(16);

        $saveData = Visitor::create([
            'name' => $name,
            'token' => $token,
        ]);

        $saveMessageVisitor = Chat::create([
            'visitor_id' => $saveData->id,
            'body' => $name,
            'sent_by' => "visitor"
        ]);

        sleep(1);

        $saveMessageBot = Chat::create([
            'visitor_id' => $saveData->id,
            'body' => "Halo ".$name.", senang berkenalan dengan kamu. Sekarang apa yang bisa saya bantu?",
            'sent_by' => "bot"
        ]);
        
        $toReturn = [
            'token' => $token,
            'visitor' => $saveData,
            "conversations" => [
                ["body" => "Halo ".$name.", senang berkenalan dengan kamu. Sekarang apa yang bisa saya bantu?"]
            ]
        ];
        $toReturn['visitor']['id'] = $saveData->id;

        return response()->json($toReturn);
    }
    public function conversation(Request $request) {
        $visitorID = $request->id;

        $datas = Chat::where([
            'visitor_id' => $visitorID
        ])
        ->orderBy('created_at', 'DESC')->take($request->limit)
        ->get();
        
        return response()->json([
            'conversations' => $datas
        ]);
    }
    public function removeConjunction($sentences) {
        return array_diff($sentences, config('wordbank')['conjunction']);
    }
    public function sendConversation(Request $request) {
        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();
        $visitor = Visitor::where('id', $request->visitorID)->first();

        $sentence = $request->text;
        $stemmedSentence = $stemmer->stem($sentence);
        $sentences = explode(" ", $stemmedSentence);
        
        $context = null;
        $botMessage = "";
        $interestedBook = null;
        $interestedService = null;
        
        $days = ["senin","selasa","rabu","kamis","jumat","sabtu","minggu"];

        if (in_array('buku', $sentences)) {
            $sentences = array_diff($sentences, ["apa","gimana","info","tentang"]);
            if (in_array('pinjam', $sentences)) {
                $context = "borrow-book";
            } else {
                $context = "ask-book";
            }
        } else if (in_array('layan', $sentences)) {
            if (in_array('jam', $sentences) || in_array('buka', $sentences) || in_array('tutup', $sentences) || in_array('berapa', $sentences)) {
                $context = "available-service";
                $sentences = array_diff($sentences, ["jam","buka","tutup","berapa"]);
            } else {
                $context = "ask-service";
            }
            $sentences = array_diff($sentences, ["layan"]);
        } else if (in_array('jam', $sentences) || in_array('buka', $sentences) || in_array('tutup', $sentences) || in_array('berapa', $sentences)) {
            $context = "available-service";
            $selectedDay = null;
            foreach ($sentences as $item) {
                if (in_array(strtolower($item), $days)) {
                    $selectedDay = $item;
                }
            }

            if ($selectedDay != null) {
                $context = "available-service-day";
            }
            
            $sentences = array_diff($sentences, ["jam","buka","tutup","berapa"]);
        } else if (in_array('hai', $sentences) || in_array('halo', $sentences) || in_array('selamat', $sentences)) {
            $context = "greetings";
        } else {
            $context = "unknown-question";
        }

        $sentences = $this->removeUnnecessary($sentences);
        $sentences = $this->removeConjunction($sentences);

        if ($context == "greetings") {
            $names = explode(" ", $visitor->name);
            $botMessage = "Halo ".$names[0].", ada yang bisa saya bantu?";
        }else if ($context == "ask-book" || $context == "borrow-book") {
            $layanan = LayananController::get([['name', "LIKE", "%".implode(' ', $sentences)."%"]])
            ->orWhere('stemmed_name', "LIKE", "%".implode(' ', $sentences)."%")
            ->first();

            if ($layanan != "") {
                $botMessage = $layanan->description;
            } else {
                $book = BukuController::get([
                    ['judul', "LIKE", "%".implode(" ", $sentences)."%"]
                ])->first();
    
                if ($book != "") {
                    $interestedBook = $book->id;
                    if ($context == "ask-book") {
                        $botMessage = "<b>".$book->judul."</b><br /><br />".$book->penulis."<br />".$book->penerbit."<br />".$book->tahun_terbit;
                    } else {
                        $botMessage = "Untuk meminjam buku <b><i>".$book->judul."</b></i>, Anda dapat langsung menuju perpustakaan";
                    }
                } else {
                    $botMessage = "Maaf, saya tidak dapat menemukan buku ".implode(" ", $sentences);
                }
            }
        } else if ($context == "unknown-question") {
            // Try search layanan
            $layanan = $layanan = LayananController::get([['name', "LIKE", "%".implode(' ', $sentences)."%"]])
            ->orWhere('stemmed_name', "LIKE", "%".implode(' ', $sentences)."%")
            ->first();

            if ($layanan != "") {
                $interestedService = $layanan->id;
                $botMessage = "<b>$layanan->name </b><br /><br />";
                $botMessage .= "<pre class='teks-kecil'>$layanan->description</pre>";
            } else {
                if (count($sentences) < 3) {
                    $botMessage = "Mohon maaf saya tidak mengetahui tentang hal itu, namun anda bisa mengontak pustakawan kami untuk mendapatkan informasi secara detail. Berikut adalah no kontak pustakawan UNAIR WA : +62 82231517409 atau Telp : +62 031 5030826";
                } else {
                    $book = BukuController::get([
                        ['judul', "LIKE", "%".implode(" ", $sentences)."%"]
                    ])->first();

                    if ($book != "") {
                        $interestedBook = $book->id;
                        $botMessage = "<b>".$book->judul."</b><br /><br />".$book->penulis."<br />".$book->penerbit."<br />".$book->tahun_terbit;
                    } else {
                        // Bot giving up
                        $botMessage = "Mohon maaf saya tidak mengetahui tentang hal itu, namun anda bisa mengontak pustakawan kami untuk mendapatkan informasi secara detail. Berikut adalah no kontak pustakawan UNAIR WA : +62 82231517409 atau Telp : +62 031 5030826";
                    }
                }
            }
        } else if ($context == "available-service") {
            $jadwals = JadwalController::get()->get();
            $botMessage = "<b>Jadwal operasional perpustakaan</b><br /><br />";
            foreach ($jadwals as $jadwal) {
                $openTime = $jadwal->is_covid == 1 ? $jadwal->waktu_buka_covid : $jadwal->waktu_buka;
                $closeTime = $jadwal->is_covid == 1 ? $jadwal->waktu_tutup_covid : $jadwal->waktu_tutup;
                $botMessage .= $jadwal->hari." : ".$openTime." - ".$closeTime." <br />";
            }
        } else if ($context == "available-service-day") {
            $jadwal = JadwalController::get([['hari', $selectedDay]])->first();
            $openTime = $jadwal->is_covid == 1 ? $jadwal->waktu_buka_covid : $jadwal->waktu_buka;
            $closeTime = $jadwal->is_covid == 1 ? $jadwal->waktu_tutup_covid : $jadwal->waktu_tutup;
            $botMessage = "Untuk hari ".$selectedDay." buka jam ".$openTime." hingga ".$closeTime;
        } else if ($context == "ask-service") {
            $layanan = LayananController::get([['name', "LIKE", "%".implode(' ', $sentences)."%"]])->first();
            if ($layanan != "") {
                $interestedService = $layanan->id;
                $botMessage = "<b>Layanan $layanan->name </b><br /><br />";
                $botMessage .= "<pre class='teks-kecil'>$layanan->description</pre>";
            } else {
                $botMessage = "Maaf, layanan ".implode(' ', $sentences)." tidak dapat kami temukan";
            }
        }

        $toSaveVisitor = [
            'visitor_id' => $visitor->id,
            'body' => $sentence,
            'sent_by' => "visitor",
            'processed_body' => $stemmedSentence
        ];
        if ($interestedBook != null) {
            $toSaveVisitor['interested_book'] = $interestedBook;
        }
        if ($interestedService != null) {
            $toSaveVisitor['interested_service'] = $interestedService;
        }

        $saveMessageVisitor = Chat::create($toSaveVisitor);

        sleep(1);

        $saveMessageBot = Chat::create([
            'visitor_id' => $visitor->id,
            'body' => $botMessage,
            'sent_by' => "bot"
        ]);

        return response()->json([
            'data' => $sentence,
            'sentences' => implode("-", $sentences),
            'context' => $context
        ]);
    }
}
