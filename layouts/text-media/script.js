document.addEventListener('DOMContentLoaded', function() {
	const videoWrappers = document.querySelectorAll('.layout--text-media__video-wrapper');
	
	videoWrappers.forEach(wrapper => {
		const thumbnail = wrapper.querySelector('.layout--text-media__video-thumbnail');
		
		if (!thumbnail) {
			return;
		}
		
		const playButton = thumbnail.querySelector('.layout--text-media__play-button');
		const videoId = wrapper.dataset.videoId;
		
		const playVideo = () => {
			const videoContainer = document.createElement('div');
			videoContainer.className = 'layout--text-media__video-container';
			
			const iframe = document.createElement('iframe');
			iframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
			iframe.setAttribute('frameborder', '0');
			iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
			iframe.setAttribute('allowfullscreen', '');
			
			videoContainer.appendChild(iframe);
			
			thumbnail.style.display = 'none';
			wrapper.appendChild(videoContainer);
		};
		
		playButton.addEventListener('click', playVideo);
		thumbnail.addEventListener('click', playVideo);
	});
});
