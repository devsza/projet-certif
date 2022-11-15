

<dialog id="dialogDelete" class="modal_delete" close> 
	<p class="message_confirmation_delete">Etes vous sur de vouloir supprimer ?</p> 
	<p>⚠️ ️Attention la suppression est définitive</p>
	<div class="form_buttons_delete_cancel">
    <button onclick="dialog.close()" id="close-modal" class="modal_cancel_btn">Annuler</button> 
    <form method="get">
      <input type="hidden" name="page" value="deleted"/>
      <input type="hidden" id="js_sheet_id" name="sheet_id" value=""/>
      <input type="submit" class="modal_delete_btn" value="Supprimer"/>
    </form>
  </div> 
</dialog> 