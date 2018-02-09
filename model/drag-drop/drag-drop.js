function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    markadores.forEach(n => {
        if (data == n._value) {
            map.panTo(n.getPosition());
            map.setZoom(14);
            n.setAnimation(google.maps.Animation.BOUNCE);
        } else {
            n.setAnimation(null);
        }
    });
}