<!-- Modal Hapus -->
<!-- <div class="modal fade" id="popupModalDel" tabindex="-1" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus akun ini?
            </div>
            <div class="modal-footer">
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus Akun</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="popupModalDel" tabindex="-1" role="dialog" aria-labelledby="delProvinsiModalLabel" aria-hidden="true" style="z-index: 100;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delProvinsiModalLabel">Hapus Profil</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <form action="deletea.php?id=<?= $user['ID']; ?>" method="GET"> 
        <div class="modal-body">
            Apakah anda yakin ingin menghapus?
        </div>
        <div class="modal-footer">
            <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus Akun</a>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
    </form>
    </div>
  </div>
</div>
