const $ = require('jquery')
const container = document.querySelector('#dialogContainer')

function getDeleteDialogStub(name, id, route) {
    return `
<div class="modal fade show" tabindex="-1" id="modal_delete_${id}" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
      </div>
      <div class="modal-body">
        <p>Are you sure want to delete your device?</p>
        <pre class="text-light card-text">Name    : ${name}
ID      : ${id}</pre> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_btn_close_${id}">Cancel</button>
        <form method="post" action="${route}">
            <button type="submit" class="btn btn-danger">Delete</button>
            <input type="hidden" name="_token" value="${app.csrf}">
            <input type="hidden" name="_method" value="delete">
        </form>
      </div>
    </div>
  </div>
</div>
    `;
}

function fireDeleteDialog(name, id, route) {
    container.innerHTML += getDeleteDialogStub(name, id, route)
    document.querySelector(`#modal_btn_close_${id}`).addEventListener('click', function () {
        $(`#modal_delete_${id}`).modal('hide');
        removeDeleteDialog()
    })

    $(`#modal_delete_${id}`).modal('show')
}

function removeDeleteDialog() {
    container.innerHTML = null;
}

document.addEventListener('DOMContentLoaded', function () {
    let deleteButtons = document.querySelectorAll("button[data-delete=device]");

    deleteButtons.forEach((btn) => {
        btn.addEventListener('click', function () {
            fireDeleteDialog(btn.getAttribute('data-name'), btn.getAttribute('data-id'), btn.getAttribute('data-route'))
        })
    })
})