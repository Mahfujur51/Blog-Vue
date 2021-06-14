import Vue from "vue"
import moment from "moment/moment";

Vue.filter('time',function(a){
    return moment(a).format("MMM Do YY");
});

Vue.filter('subString',function (content,lenght,s) {
    return content.substring(0,lenght)+s;

});
Vue.filter('capitalize',(value)=>{
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
});
