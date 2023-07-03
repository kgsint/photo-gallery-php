let image_popup = document.querySelector('.image-popup');
// Iterate the images and apply the onclick event to each individual image
document.querySelectorAll('.images a').forEach(img_link => {
    img_link.addEventListener('click', e => {
        e.preventDefault();
        let img_meta = img_link.querySelector('img');
        // create an image tag
        let img = new Image();
        
        img.addEventListener('load', () => {
            // Create the pop out image render in DOM
            image_popup.innerHTML = `
                <div class="con">
                    <h3>${img_meta.dataset.title}</h3>
                    <p>${img_meta.alt}</p>
                    <img src="${img.src}" width="600" height="400">

                    <form action="delete.php" method="POST" id="deleteForm">
                        <input type="hidden" name="id" value="${img_meta.dataset.id}" >
                    </form>

                    <button type="submit" form="deleteForm" class="trash" title="Delete Image"><i class="fas fa-trash fa-xs"></i></button>
                    <a href="edit.php?id=${img_meta.dataset.id}" class="edit" title="Delete Image"><i class="fas fa-edit fa-xs"></i></a>
                </div>
            `;
            image_popup.style.display = 'flex';
        });
        img.src = img_meta.src;

    });
});
// hide the popup when the user click away
image_popup.addEventListener('click', e => {
    if (e.target.className == 'image-popup') {
        image_popup.style.display = "none";
    }
});