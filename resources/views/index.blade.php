<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <style>
        body { background-color: #fff; }
        .profile,.content {
            position: absolute;
            top: 70px;
        }
        .profile {
            text-align: center;
            left: 5%;right: 45%;
        }
        .typingArea {
            position: absolute;
            top: 600px;
            box-shadow: 1px 1px 5px 1px #ddd;
            border-radius: 600px;
        }
        .typingArea .box {
            font-size: 16px;
            border-radius: 600px;
            padding: 0px 35px;
        }
        .content,.typingArea { left: 55%;right: 5% }
        .content {
            max-height: 520px;
            overflow: auto;
            z-index: 1;
        }
        
        .profile .picture {
            width: 230px;
            height: 230px;
            border-radius: 900px;
            display: inline-block;
        }
        .profile .online-status {
            background-color: #2ecc71;
            width: 30px;
            height: 30px;
            border-radius: 150px;
            display: inline-block;
            margin-left: -80px;
        }
        .profile h2 {
            font-size: 35px;
            font-family: RobotoBold;
        }
        .profile p {
            font-size: 18px;
            color: #999;
        }
        .content .message {
            display: inline-block;
            background-color: #ecf0f1;
            width: 70%;
            box-sizing: border-box;
            padding: 20px;
            border-radius: 6px;
        }
        .content .timestamp {
            margin: 10px 0px;
            font-size: 11px;
        }
        .content .message.mine {
            background-color: #3498db;
            color: #fff;
            margin-left: 30%;
        }
        .typingArea .box {
            margin: 0px;
            border: 0px;
            height: 55px;
        }

        @media (max-width: 480px) {
            .profile {
                position: fixed;
                top: 0px;left: 0px;right: 0px;
                text-align: left;
                padding: 15px;
                box-shadow: 1px 1px 5px 1px #ddd;
            }
            .profile .picture {
                width: 50px;
                height: 50px;
                float: left;
            }
            .profile .online-status { display: none; }
            .profile .info {
                float: left;
                margin-left: 15px;
            }
            .profile h2 {
                font-size: 22px;
                margin: 0px;
            }
            .profile p {
                margin: 0px;
                font-size: 14px;
                margin-top: 5px;
            }
            .content {
                left: 5%;right: 5%;bottom: 80px;
                top: 100px;
                max-height: 550px;
            }
            .typingArea {
                left: 0%;right: 0%;bottom: 0px;
                border-radius: 0px;
                z-index: 5;
            }
            .typingArea .box {
                height: 70px;
                border-radius: 0px;
            }
        }
    </style>
</head>
<body>
    
<div class="profile">
    <div class="picture" bg-image="{{ asset('images/djugeblek.jpg') }}"></div>
    <div class="online-status"></div>
    <div class="info">
        <h2>{{ env('APP_NAME') }}</h2>
        <p id="shopName">online</p>
        <p class="d-none" id="isTyping">mengetik...</p>
    </div>
</div>

<div class="content">
    <div id="render"></div>
</div>

<div class="typingArea">
    <form action="#" method="POST" id="type">
        <input type="text" class="box" placeholder="Ketik pesan...">
    </form>
</div>

<script src="{{ asset('js/base.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script>
    let state = {
        introductionMode: false,
        visitor: null,
        conversationLimit: 25,
        lastActive: null,
        minutesToReload: 2,
        token: localStorage.getItem('token')
    }
    localStorage.clear();
    let bot = {
        name: "{{ env('APP_NAME') }}"
    }

    let checking = setInterval(() => {
        if (state.lastActive != null) {
            let waktuA = state.lastActive;
            let waktuB = moment();
            let difference = waktuB.diff(waktuA, 'minutes');

            if (difference == state.minutesToReload) {
                console.log('ending chat...');
                endChat();
                scrollChatToDown();
                clearInterval(checking);
            }
        }
    }, 1000);

    const loadMore = () => {
        state.conversationLimit += 15;
        loadConversations(false);
    }

    const scrollChatToDown = () => {
        let contentArea = select(".content");
        contentArea.scrollTop = contentArea.scrollHeight;
    }

    const introduction = (introMessage = null) => {
        if (introMessage == null) {
            let timeNow = moment().format('H');
            let greetingsTime = "";
            if (timeNow >= 3 && timeNow < 11) {
                greetingsTime = "pagi";
            } else if (timeNow >= 11 && timeNow < 15) {
                greetingsTime = "siang";
            } else if (timeNow >= 15 && timeNow < 20) {
                greetingsTime = "sore";
            } else if (timeNow >= 20 || timeNow < 3) {
                greetingsTime = "malam";
            }
            introMessage = `Selamat ${greetingsTime}. Boleh saya tahu nama kamu?`;
        }
        createElement({
            el: 'div',
            attributes: [
                ['class', 'message']
            ],
            html: introMessage,
            createTo: '.content #render'
        });
    }

    const renderConversations = (conversations, withScrollDown = true) => {
        conversations = conversations.reverse();
        if (conversations.length == 0) {
            createElement({
                el: 'div',
                attributes: [
                    ['class', 'message']
                ],
                html: `Halo ${visitor.name}, ada yang bisa ${bot.name} bantu?`,
                createTo: '.content #render'
            });
            return false;
        }


        select(".content #render").innerHTML = "";
        
        createElement({
            el: 'div',
            attributes: [
                ['class', 'rata-tengah mt-1 mb-2']
            ],
            html: `<span class="teks-biru teks-tebal pointer" onclick="loadMore()">load more...</span>`,
            createTo: '.content #render'
        });

        conversations.forEach(item => {
            let classes = "message";
            let timestampClasses = "teks-kecil timestamp";
            if (item.sent_by == "visitor") {
                classes += " mine";
                timestampClasses += " rata-kanan pr-1";
            } else {
                timestampClasses += " pl-1";
            }
            createElement({
                el: 'div',
                attributes: [
                    
                ],
                html: `<div class="${classes}">${item.body}</div>
                <div class="${timestampClasses}">${moment(item.created_at).format('LT')}</div>`,
                createTo: '.content #render'
            });
        });
        
        if (withScrollDown) {
            scrollChatToDown();
        }
    }

    const endChat = () => {
        localStorage.clear();
        introduction("Terima kasih telah menghubungi perpustakaan UNAIR, sampai jumpa kembali. <a href='./'>Mulai ulang</a>");
    }
    const postConversation = (message, callback = null) => {
        if (state.token == "") {
            return false;
        }
        let req = post("{{ route('api.conversation.send') }}", {
            text: message,
            visitorID: state.visitor.id
        })
        .then(res => {
            if (callback == null) {
                console.log(res);
                loadConversations();
            } else {
                callback(res);
            }
        })
    }

    const loadConversations = (withScrollDown = true) => {
        let getConversations = post("{{ route('api.conversation') }}", {
            id: state.visitor.id,
            limit: state.conversationLimit
        })
        .then(res => {
            renderConversations(res.conversations, withScrollDown);
        })
    }

    select("form#type").onsubmit = function (e) {
        let input = e.currentTarget.childNodes[1];
        let question = input.value;

        if (state.introductionMode) {
            let req = post("{{ route('api.introduction') }}", {
                text: question
            })
            .then(res => {
                console.log(res);
                state.introductionMode = false;
                state.visitor = res.visitor;
                localStorage.setItem('token', res.token);
                loadConversations();
            });
        } else {
            postConversation(question);
        }

        input.value = "";
        state.lastActive = moment();

        e.preventDefault();
    }

    const isUserHasRecognized = () => {
        if (state.token == null) {
            state.introductionMode = true;
            introduction();
        } else {
            let getVisitorData = get(`{{ route('api.visitor.info') }}/${state.token}`)
            .then(res => {
                console.log(res);
                state.visitor = res.data;
                loadConversations();
            });
        }
    }

    isUserHasRecognized();
</script>

</body>
</html>