function Player(){
	
}

Player.prototype.play = function(song) {
  this.currentlyPlayingSong = song;
  this.isPlaying = true;
};

Player.prototype.pause = function() {
  this.isPlaying = false;
};

Player.prototype.resume = function() {
  if (this.isPlaying) {
    throw new Error("song is already playing");
  }

  this.isPlaying = true;
};

Player.prototype.makeFavorite = function() {
  this.currentlyPlayingSong.persistFavoriteStatus(true);
};

Player.prototype.togglePlay = function(song) { 
    if ( this.isPlaying ) { 
        this.pause(); 
    } 
    else { 
        this.play(song); 
    } 
} 
