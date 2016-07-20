<div class="container wrapper">
    <!-- Modal -->
    <div class="modal fade" id="modalDg" tabindex="-1" role="dialog" aria-labelledby="modalDgLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"></h4>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <form class="formvalidation" id="designer" method="post" enctype="multipart/form-data" action="<?=PAGE_DOMAIN?>">
        <div class="row">
            <?=$data["designer"]?>
        </div>
    </form>
</div>
