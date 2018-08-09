function getCookie(n) {
    let a = `; ${document.cookie}`.match(`;\\s*${n}=([^;]+)`);
    return a ? a[1] : '';
}
$.ajaxSetup({
    headers: {
        'Authorization': getCookie('authorization')
    }
});