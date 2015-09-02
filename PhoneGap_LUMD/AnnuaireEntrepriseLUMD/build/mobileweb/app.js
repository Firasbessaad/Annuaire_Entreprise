var win = Ti.UI.createWindow();
var webview = Ti.UI.createWebView({
    url: 'http://annuaire.sqli-services.com/annuair.php'
});
win.add(webview);
win.open();