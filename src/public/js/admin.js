function openModal(id) {
    console.log('Opening modal:', id);
    var modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.style.display = 'block';
        console.log('Modal found and displayed');
    } else {
        console.error('Modal not found:', 'modal-' + id);
    }
}

function closeModal(id) {
    console.log('Closing modal:', id);
    var modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.style.display = 'none';
    }
}

// モーダル外をクリックしたら閉じる
window.onclick = function (event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}

// 削除確認
document.addEventListener('DOMContentLoaded', function () {
    const deleteForms = document.querySelectorAll('form[action*="/admin/delete/"]');

    deleteForms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!confirm('本当に削除しますか？')) {
                e.preventDefault();
            }
        });
    });
});