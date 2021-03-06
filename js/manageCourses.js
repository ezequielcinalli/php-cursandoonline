document.addEventListener("DOMContentLoaded", initPage);

function initPage() {
    const image = document.querySelector("#imagenPreview");
    const inputFile = document.querySelector("#imagen");
    const labelInput = document.querySelector(".custom-file-label");
    const buttonClean = document.querySelector("#quitar");
    const inputImageState = document.querySelector("#estadoImagen");

    //al cambiar el estado del input, si se cargo una imagen
    //la carga en el src de la imagen oculta
    inputFile.addEventListener("change", () => {
        const archivos = inputFile.files;
        if (!archivos || !archivos.length) {
            return;
        }
        const primerArchivo = archivos[0];
        labelInput.innerHTML = primerArchivo.name;
        const objectURL = URL.createObjectURL(primerArchivo);
        image.src = objectURL;
        buttonClean.disabled = false;
    });

    // al cambiar el estado del input, si se cargo una imagen
    // la carga en el src de la imagen de muestra
    buttonClean.addEventListener("click", () => {
        labelInput.innerHTML = "Seleccionar archivo";
        image.src = "images/system/sin_imagen.jpg";
        inputFile.value = "";
        buttonClean.disabled = true;
        inputImageState.value = "borrar";
    });
}