window.onload = function () {
  let save_button = document.getElementById("save") || null;
  let remove_button = document.getElementById("remove") || null;
  if (save_button)
    save_button.onclick = () => {
      location.href =
        "notificari_change.php?action=save&id=" + save.getAttribute("data_id");
    };
  if (remove_button)
    remove_button.onclick = () => {
      location.href =
        "notificari_change.php?action=remove&id=" +
        remove.getAttribute("data_id");
    };
};
