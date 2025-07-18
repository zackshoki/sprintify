// spotify functions
function populateUI(profile) {
    if (document.getElementById("displayName") != null) {document.getElementById("displayName").innerText = profile.display_name;}
    if (profile.images[0]) {
        const profileImage = new Image(200, 200);
        profileImage.src = profile.images[0].url;
        document.getElementById("avatar").appendChild(profileImage);
    }
    if (document.getElementById("email") != null) {document.getElementById("email").innerText = profile.email;}
    if (document.getElementById("url") != null) {document.getElementById("url").innerText = profile.href;}
    if (document.getElementById("url") != null) {document.getElementById("url").setAttribute("href", profile.href)};
}

function showPlaylist(playlist) {
    document.getElementById("playlistName").innerText = playlist.name; 
    if (playlist.images[0]) {
        const playlistImage = new Image(200, 200);
        playlistImage.src = playlist.images[0].url;
        document.getElementById("playlistImage").appendChild(playlistImage);
    }
    let songNames = []; 
    playlist.tracks.items.forEach((item) => {
        songNames.push(item.track.name + " - " + item.track.artists[0].name); 
    });

    document.getElementById("songNames").innerText = JSON.stringify(songNames);
    document.title = playlist.name;
}

