/*
 ***********************************************************/
/**
 * @name          : Facebook Page Builder.
 * @version	      : 1.2
 * @package       : apptha
 * @since         : Joomla 1.6
 * @subpackage    : Facebook Page Builder.
 * @author        : Apptha - http://www.apptha.com
 * @copyright     : Copyright (C) 2011 Powered by Apptha
 * @license       : GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @abstract      : Customize facebook fanpage design and controll it from this component.
 * @Creation Date : July 20 2011
 * @Modified Date : November 8 2011
 * */

/*
 ***********************************************************/
var content = '';
var title = '';

//content save after edit
function save(id){
 
    var content =  $('#duplicate-content-'+id).html();    
    $('#content-'+id).html(content);
    parent.$.fn.colorbox.close();
   
}
//get video from youtube.
function dynamic_Select(ajax_page, path, id)
{
    var width = $('#video-'+id).width();
    var height = $('#video-'+id).height();
    $.ajax({
        type: "GET",
        url: ajax_page,
        data: "youtube-value=" + path + "&width=" + width + "&height=" + height,
        dataType: "text/html",
        success: function(html){
            $('#video-'+id).html(html);
            parent.$.fn.colorbox.close();
        }

    });
}
//script for upload and save croped image
function resize(id,width,height,url,basepath,page,template)
{
    var path = $('#bind-'+id).attr('title');
    var position = id;
    var width = width;
    var height = height;
    var left = $('#bind-'+id).css('margin-left');
    var top = $('#bind-'+id).css('margin-top');
    $.ajax({
        type: 'GET',
        url: url,
        data: 'imagename=' + path + '&width=' + width + '&height=' + height+ '&left=' + left+ '&top=' + top+'&crop=1&url='+basepath+'&page='+page+'&tmp='+template+'&position='+position,
        dataType: 'text/html',
        success: function(html){
            $('#image-'+id).html(html);
            parent.$.fn.colorbox.close();
        }
    });
}
//delete uploaded image
function deleteimage(id,page,template,libpath)
{
    var imgname = $('#bind-'+id).attr('title');
    var path = 'tmp-'+template+'/customized/page-'+page+'/'+imgname;
    $.ajax({
        type: 'GET',
        url: libpath,
        data: 'imagepath=' + path +'&delete=1',
        dataType: 'text/html',
        success: function(html){
            $('#swfupload-control-'+id).show();
            $('#crop-'+id).html('');
            $('#pophead-'+id).css('display', 'none');    
        }
    });
}
//script for crop uploaded image
function updatePreview(c,id)
{
    $('#bind-'+id).css('margin-left',c.x);
    $('#bind-'+id).css('margin-top',c.y);
}
//check title is selected or not.
function installcheck(errormsg)
{
         var content = $('#template-changed').html(); 
         $('#content').val(content);
        //pop up when click install
        $('#install').colorbox({
            width:'34%',
            height:'36%',
            inline:true,
            href:'#install-fbpage'
        });
    
}
//send details to install db and redirected to facebook and close popup.

function installpage(user,template,id,url,title)
{
    var content = escape($('#content').val());
    var fburl = 'https://www.facebook.com/add.php?api_key='+ title +'&pages=1';
     var newWin = window.open(fburl);
    var i = 0;
    if (newWin && newWin.top && i==0) {
        i++;
       $.ajax({
        type: 'POST',
        url:url,
        data: 'fb-user='+user+'&template-id='+template+'&content=' + content +'&title=' + title +'&page='+id,
        dataType: 'text/html',
        success: function(html){
        top.location.href = html;
        parent.$.fn.colorbox.close();       
        }
    });
    
} else {
    alert('You have a popup blocker enabled. Please allow popup');
    parent.$.fn.colorbox.close();   
}

}
function installeditpage(user,template,id,url)
{var content = escape($('#template-changed').html());   
    $.ajax({
        type: 'POST',
        url:url,
        data: 'fb-user='+user+'&template-id='+template+'&content=' + content +'&page='+id,
        dataType: 'text/html',
        success: function(html){
            top.location.href = html;
            parent.$.fn.colorbox.close();
        }
    });
}
