<div class="modal fade" id="popupModalDel" tabindex="-1" role="dialog" aria-labelledby="delProvinsiModalLabel" aria-hidden="true" style="z-index: 100;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delProvinsiModalLabel">Hapus Data Penggilingan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <form action="delete.php?id=<?= $penggilingan['ID']; ?>" method="GET"> 
        <div class="modal-body">
            Apakah anda yakin ingin menghapus?
        </div>
        <div class="modal-footer">
            <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus Data</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
    </form>
    </div>
  </div>
</div>
