//kissmetrics
var _kmq = _kmq || [];
function _kms(u){
setTimeout(function(){
var s = document.createElement('script'); var f = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true;
s.src = u; f.parentNode.insertBefore(s, f);
}, 1);
}
_kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/88905aaa6b33b8385a57a090174e5c7774c9e2c5.1.js');

//_kmq.push(['identify', readCookie('ID')]);

//google analytics
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-31453177-1']);
_gaq.push(['_setCampSourceKey', 'utm_source']);
_gaq.push(['_setCampMediumKey', 'utm_medium']);
_gaq.push(['_setCampContentKey', 'utm_keyword']);
_gaq.push(['_setCampTermKey', 'utm_keyword']);
_gaq.push(['_setCampNameKey', 'utm_campaign']);
_gaq.push(['_setDomainName', 'tidepool.co']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();


function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

llactid=22187;
document.write("<script type=\"text/javascript\" language=\"javascript\" src=\"http://t6.trackalyzer.com/trackalyze.js\"></script>");