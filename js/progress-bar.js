function addProgress(value) {
    var overloadedClassName = 'red-bar';
    var progressTxtId = '#progessTxt';
    var elem = document.getElementById('select-bar');
    var progressBar = document.getElementById(elem.value);
    var width = progressBar.getAttribute('data-bar-value');
    var newWidth = ((+ width + value) > 0) ? (+ width + value) : 0;
    var limit = progressBar.getAttribute("data-bar-limit");
    var id = setInterval(frame, 10);
    function frame() {
        if ((newWidth != 0 && width == newWidth) || (newWidth <= 0 && progressBar.parentNode.querySelector(progressTxtId).innerHTML == '0%')) {
            clearInterval(id);
        } else {
            width = (width < newWidth) ? + width + 1 : + width - 1; 
            width = (width < 0) ? 0 : width;

            var percentage = Math.floor(width / limit * 100);
            if (percentage > 100) {
                var percentageBar = 100;
                if (!progressBar.classList.contains(overloadedClassName)) {
                    progressBar.classList.add(overloadedClassName);
                }
            } else {

                if (progressBar.classList.contains(overloadedClassName)) {
                    progressBar.classList.remove(overloadedClassName);
                }
                var percentageBar = percentage;
            }

            progressBar.style.width = percentageBar + '%'; 
            progressBar.parentNode.querySelector(progressTxtId).innerHTML = percentage + '%';
        }
    }
    progressBar.setAttribute('data-bar-value', + newWidth);
}