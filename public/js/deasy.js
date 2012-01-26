preRemoveVhost = function (e) {
    return confirm('Do you really want to remove the vhost?');
}

/**
 * callback for  remove virtual host request
 * hide the removed vhost
 * @param e ajax answer
 */
onRemoveVhost = function (e) {
    if (e.status == "OK") {
        $('#vhost_' + e.vhostId).hide();
        alert('The vhost was removed successfully!');
    }
}

preRemoveVhostList = function (e) {
    return confirm('Do you really want to remove the list of vhosts?');
}

/**
 * callback for  remove virtual hosts request
 * hide the removed vhosts
 * @param e ajax answer
 */
onRemoveVhostList = function (e) {
    if (e.status == "OK" || e.status == "PARTLY") {
        for (var i=0; i < e.vhostIds.length; i++) {
           $('#vhost_' + e.vhostIds[i]).hide();
        }
        e.status == "OK" ? alert('The vhosts were removed successfully!') : alert('Not all the vhosts were removed successfully!');
    }
}

$(document).ready(function() {
  // Add an ability to
   if ($('#copyConfig').length > 0) {
       var clip = new ZeroClipboard.Client();
       clip.glue( 'copyConfig' );
       clip.setHandCursor( true );

       clip.addEventListener( 'mouseDown', function(client) {
           var text = '';
           text += $.trim($('#localConfig #preVhostList').text())+"\n\n";
           $('.vhostConfRecord').each(function() {text += "\t" + $.trim($(this).text())+"\n"; return true;});
           text += $('#localConfig #postVhostList').text();
           clip.setText(text);
       });
   }
});

