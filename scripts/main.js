
function populateUI(profile) {
    if (document.getElementById("displayName") != null) {document.getElementById("displayName").innerText = profile.display_name;}
    if (profile.images[0]) {
        const profileImage = new Image(200, 200);
        profileImage.src = profile.images[0].url;
        document.getElementById("avatar").appendChild(profileImage);
    }
    if (document.getElementById("email") != null) {document.getElementById("email").innerText = profile.email;}
    if (document.getElementById("url") != null) {document.getElementById("url").setAttribute("href", profile.external_urls.spotify)};
}

function showPlaylist(playlist) {
    document.getElementById("playlistName").innerText = playlist.name; 
    if (playlist.images[0]) {
        const playlistImage = new Image(200, 200);
        playlistImage.src = playlist.images[0].url;
        document.getElementById("playlistImage").appendChild(playlistImage);
    }
    document.title = playlist.name;
}

