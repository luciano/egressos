const fileName = document.getElementById('file-name');

$('#file-upload').on('change', (e) => {
  fileName.textContent = e.currentTarget.value.substring(e.currentTarget.value.lastIndexOf('\\') + 1);
});