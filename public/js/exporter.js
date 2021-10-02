const replacer = (key, val) => {
    return val === null ? '' : val;
}

const downloadFile = (dataCSV, fileName) => {
    let downloadLink = document.createElement('a');
    let blob = new Blob(['\ufeff', dataCSV]);
    let url = URL.createObjectURL(blob);

    downloadLink.href = url;
    downloadLink.download = fileName;
    downloadLink.click();
}

const exportToCSV = (datas, fileName) => {
    datas = JSON.parse(datas);
    const header = Object.keys(datas[0]);
    let csv = datas.map(row => header.map(fieldName => JSON.stringify(row[fieldName], replacer)).join(','));
    csv.unshift(header.join(','));
    csv = csv.join('\r\n');
    downloadFile(csv, fileName);
}