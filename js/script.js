var tot = 24;

window.addEventListener("load", function () {

    if (document.querySelector(".async-ads")) {
        setTimeout(function () {
            document.querySelector(".async-ads").classList.add("hidden");
            setTimeout(function () {
                document.querySelector(".async-ads").classList.remove("hidden");
            }, 3000);
        }, 3000);
    }

    if (!isMobile()) {
        if (this.document.querySelectorAll(".adsbygoogle-noablate").length == 0) {
            document.querySelector(".add-butt").style.bottom = null;
            if (document.querySelector(".edit-butt")) document.querySelector(".edit-butt").style.bottom = "100px";
        } else {
            document.querySelector(".add-butt").style.bottom = "150px";
            if (document.querySelector(".edit-butt")) document.querySelector(".edit-butt").style.bottom = "230px";
        }
    }

    if (document.querySelector("#upload-thumbnails")) {
        document.querySelector("#upload-thumbnails").addEventListener("change", function () {
            var formData = new FormData();
            var file_name = String(Date.now()) + "_" + this.files[0].name;
            formData.append("file", this.files[0], file_name);


            var url = URL.createObjectURL(this.files[0]);
            var img = new Image;

            var xhttp = new XMLHttpRequest();

            // Set POST method and ajax file path
            xhttp.open("POST", "upload", true);

            // call on request changes state
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    var response = this.responseText;
                    if (response == 1) {

                        img.onload = function () {

                            var image_width = img.width;
                            var image_height = img.height;

                            if (image_width / image_height >= 14 / 9 && image_width / image_height <= 21 / 9) {
                                document.querySelector("#images_path").value += file_name + ';';
                                document.querySelector(".uploaded-images").innerHTML += "<div class='img' onclick='removeUpload(this, &apos;" + file_name + "&apos;);'><img src='uploads/" + file_name + "'/><i class='bx bx-x-circle'></i></div>"
                                document.querySelector(".uploaded-images").appendChild(document.querySelector(".upload-field"))
                            } else {
                                showTimerAlert("The image must have a 16:9 aspect ratio. We suggest using an image size of 1920x1080 pixels.");
                            }

                            URL.revokeObjectURL(img.src);
                        };

                        img.src = url;

                    } else {
                        showTimerAlert("File not uploaded.");
                    }
                }
            };

            // Send request with data
            xhttp.send(formData);
        });
    }

    var search_input = document.querySelector(".search-input input");
    if (search_input) {
        search_input.addEventListener("change", function () {
            const tabs = document.querySelectorAll(".tab-dashboard>div");
            var filter = search_input.value.toLowerCase();
            tabs.forEach((tab) => {
                tab.classList.remove("hidden");
            });
            if (document.querySelector(".empty")) document.querySelector(".empty").remove();
            tabs.forEach((tab) => {
                if (!tab.innerText.toLowerCase().includes(filter) && tab.classList.contains("card")) {
                    tab.classList.add("hidden");
                }
            });
            var tot_tabs = document.querySelector(".tab-dashboard").children.length/3;
            tabs.forEach((tab) => {
                if (tab.classList.contains("hidden")) {
                    tot_tabs--;
                }
            });
            if (tot_tabs == 0) {
                document.querySelector(".tab-dashboard").innerHTML += "<div class='empty'>"
                    + "<img alt='' src='assets/no-data.svg'>"
                    + "<h3>No Items Found</h3>"
                    + "<h4>Please try your search again with another keywords.</h4>"
                + "</div>";
            }
        });
    }

    // IMAGE SLIDER
    var count_image = 0, canClick = true;
    if (document.querySelector(".previous-image")) {
        document.querySelector(".previous-image").addEventListener("click", function () {

            if (!canClick) {
                canClick = true;
                return;
            }
            canClick = false;

            document.querySelectorAll("section.main img")[count_image].classList.add("hide-image-left");
            document.querySelectorAll("section.main img")[count_image].classList.remove("show-image");
            count_image--;
            document.querySelectorAll("section.main img")[count_image].classList.remove("hide-image-left");
            document.querySelectorAll("section.main img")[count_image].classList.remove("hide-image-right");

            setTimeout(function () {
                document.querySelectorAll("section.main img")[count_image + 1].classList.add("hidden");
                document.querySelectorAll("section.main img")[count_image].classList.remove("hidden");
                setTimeout(function () {
                    document.querySelectorAll("section.main img")[count_image].classList.add("show-image");
                    canClick = true;
                }, 10);
            }, 300);

            document.querySelector(".next-image").classList.remove("disable-arrow");
            if (count_image == 0) {
                document.querySelector(".previous-image").classList.add("disable-arrow");
            }
        });
    }

    if (document.querySelector(".next-image")) {
        document.querySelector(".next-image").addEventListener("click", function () {

            if (!canClick) {
                canClick = true;
                return;
            }
            canClick = false;

            document.querySelectorAll("section.main img")[count_image].classList.add("hide-image-right");
            document.querySelectorAll("section.main img")[count_image].classList.remove("show-image");
            count_image++;
            document.querySelectorAll("section.main img")[count_image].classList.remove("hide-image-left");
            document.querySelectorAll("section.main img")[count_image].classList.remove("hide-image-right");

            setTimeout(function () {
                document.querySelectorAll("section.main img")[count_image - 1].classList.add("hidden");
                document.querySelectorAll("section.main img")[count_image].classList.remove("hidden");
                setTimeout(function () {
                    document.querySelectorAll("section.main img")[count_image].classList.add("show-image");
                    canClick = true;
                }, 10);
            }, 300);

            document.querySelector(".previous-image").classList.remove("disable-arrow");
            if (count_image == document.querySelectorAll("section.main img").length - 1) {
                document.querySelector(".next-image").classList.add("disable-arrow");
            }
        });
    }

});

window.addEventListener("keydown", function (event) {

    if (event.ctrlKey && (event.keyCode === 70)) { // f
        event.preventDefault();
        location.href = "search";
    }

});

function putLike(event) {
    event.cancelBubble = true;
    event.stopPropagation();

    if (document.cookie.indexOf('login_user=') == "-1") {
        location.href = "/login";
        return;
    }

    $.ajax({
        url: '/likes',
        type: 'POST',
        data: {
            id_startup: event.target.dataset.id
        },

        success: function (data) {
            event.target.children[0].classList.toggle("bx-heart");
            event.target.children[0].classList.toggle("bxs-heart");
            if (event.target.children[0].classList.contains("bxs-heart")) {
                showTimerAlert("Startup added to likes.");
            } else {
                showTimerAlert("Startup removed from likes.");
            }
        }

    });
}

window.addEventListener("scroll", function () {
    if (window.scrollY < 50) {
        document.querySelector("header").classList.remove("opacity-header");
    } else {
        document.querySelector("header").classList.add("opacity-header");
    }
});

function removeUpload(ev, file_name) {
    ev.remove();
    document.querySelector("#images_path").value = document.querySelector("#images_path").value.replace(file_name + ';', "");
}

function getAverageRGB(imgEl) {

    var blockSize = 5, // only visit every 5 pixels
        defaultRGB = { r: 0, g: 0, b: 0 }, // for non-supporting envs
        canvas = document.createElement('canvas'),
        context = canvas.getContext && canvas.getContext('2d'),
        data, width, height,
        i = -4,
        length,
        rgb = { r: 0, g: 0, b: 0 },
        count = 0;

    if (!context) {
        return defaultRGB;
    }

    height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
    width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

    context.drawImage(imgEl, 0, 0);

    try {
        data = context.getImageData(0, 0, width, height);
    } catch (e) {
        /* security error, img on diff domain */alert('x');
        return defaultRGB;
    }

    length = data.data.length;

    while ((i += blockSize * 4) < length) {
        ++count;
        rgb.r += data.data[i];
        rgb.g += data.data[i + 1];
        rgb.b += data.data[i + 2];
    }

    // ~~ used to floor values
    rgb.r = ~~(rgb.r / count);
    rgb.g = ~~(rgb.g / count);
    rgb.b = ~~(rgb.b / count);

    return rgb;

}

const isHexTooLight = (hexColor) =>
  (([r, g, b]) =>
    (((r * 299) + (g * 587) + (b * 114)) / 1000) > 155)
  (hexColor);

function deleteQueryString() {
    var uri = window.location.toString();

    if (uri.indexOf("?") > 0) {
        var clean_uri = uri.substring(0, uri.indexOf("?"));
        window.history.replaceState({}, document.title, clean_uri);
    }
}

window.onclick = function () {

    if (isMobile()) return;

    if (!event.target.classList.contains("grippy-host")) return;
    var status = event.target.parentNode.dataset.anchorStatus;

    document.querySelector(".add-butt").style.transition = "0s";
    if (document.querySelector(".edit-butt")) document.querySelector(".edit-butt").style.transition = "0s";

    if (status == "displayed") {
        document.querySelector(".add-butt").style.bottom = null;
        if (document.querySelector(".edit-butt")) document.querySelector(".edit-butt").style.bottom = "100px";
    } else {
        document.querySelector(".add-butt").style.bottom = "150px";
        if (document.querySelector(".edit-butt")) document.querySelector(".edit-butt").style.bottom = "230px";
    }
}

function isMobile() {
    var match = window.matchMedia || window.msMatchMedia;
    if (match) {
        var mq = match("(pointer:coarse)");
        return mq.matches;
    }
    return false;
}