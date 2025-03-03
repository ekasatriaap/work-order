$(function () {
  setCsrf();
});
const setCsrf = (response) => {
  csrf = response?.csrf;
  if (csrf) {
    $('meta[name="csrf-token"]').attr("content", response.csrf);
  }
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
};

const ajaxMasterSimpan = (form, url, method = "POST") => {
  loaderPage(true);

  return new Promise((resolve, reject) => {
    $.ajax({
      url: url,
      type: method,
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          iziToast.success({
            title: "Sukses..",
            message: response.message,
            position: "topRight",
          })
        } else {
          iziToast.warning({
            title: "Oops..",
            message: response.message,
            position: "topRight",
          })
        }

        resolve(response);
      },
      error: function (err) {
        handleError(err);
        reject(err);
      },
    })
      .done(function (z) {
        return false;
      })
      .always(function () {
        loaderPage(false);
      });
  });
};

const loaderPage = (load = false) => {
  if (load === true) {
    $(
      '<div loader_body ><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>'
    )
      .appendTo(document.body)
      .hide()
      .fadeIn(200);
  } else {
    $("[loader_body]").fadeOut(200, function () {
      $(this).remove();
    });
  }
};

const setInvalidFeedBack = (error, form, nameArrayKeyCustom = false) => {
  let errs = error.responseJSON?.errors;
  let splitName = "."; //
  let formInputan;

  cleanInvalidFeedBack(form);
  if (errs) {
    for (let [inputName, errorMessage] of Object.entries(errs)) {
      //jika name menggunakan key yang custom  semisal nama[0], nama[2], nama[5]
      if (nameArrayKeyCustom) {
        let splitArr = inputName.split(splitName);
        inputName = "";
        for (let index = 0; index < splitArr.length; index++) {
          if (index == 0) inputName += splitArr[index];
          else inputName += `[${splitArr[index]}]`;
        }

        formInputan = $(`[name^="${inputName}"]`);
      } else {
        // jika key tedapat ".", maka name berbentuk array, semisal: nama[]
        let keyInputan = 0;
        if (inputName.includes(splitName)) {
          let splitArr = inputName.split(splitName);
          keyInputan = splitArr[splitArr.length - 1];
          splitArr.splice(splitArr.indexOf(keyInputan), 1); // remove last Value
          inputName = splitArr[0];
        }

        formInputan = $(`[name^="${inputName}"]`);

        if (formInputan.length > 1) {
          formInputan = $(formInputan[keyInputan]); //reinit
        }
      }

      if (formInputan.hasClass("image-input")) {
        formInputan
          .closest(".image-input-pembungkus")
          .find(".image-input-messsage")
          .append(
            `<div class="text-danger invalid-message">${errorMessage}</div>`
          );
      } else {
        formInputan
          .addClass("is-invalid")
          .parent()
          .append(
            `<div class="invalid-feedback invalid-message">${errorMessage}</div>`
          );
      }
    }
  }

  return errs;
};

const cleanInvalidFeedBack = (form) => {
  $(form).find("input,select").removeClass("is-invalid");
  $(form).find(".invalid-message").remove();
};

const handleError = (err) => {
  if (err.status == 422) {
    iziToast.error({
      title: "Oops..",
      message: "Periksa kembali inputan anda!",
      position: "topRight",
    });
    return false;
  }

  if (err.status == 404) {
    iziToast.error({
      title: "Oops..",
      message: "Data tidak ditemukan!",
      position: "topRight",
    });
    return false;
  }

  if (err.responseJSON.message) {
    iziToast.error({
      title: "Oops..",
      message: err.responseJSON.message,
      position: "topRight",
    });
    return false;
  }
};

const alertSweet = (text, icon = "success") => {
  if (icon === true) {
    icon = "success";
  } else if (icon === false) {
    icon = "error";
  }

  return swal({
    text: text,
    icon: icon,
    buttonsStyling: false,
    buttons: {
      confirm: {
        text: "Oke!",
        className: "btn btn-primary",
      }
    }
  });
};

const ajaxHapusData = (
  src,
  sendData = {},
  redirectLocation = false,
  typeDelete = ""
) => {
  if (!src) {
    iziToast.error({
      title: "Oops..",
      message: "Alamat src tujuan tidak valid!",
      position: "topRight",
    });
    return false;
  }

  let message = `Yakin hapus data, data akan dihapus dari sistem!`;

  if (typeDelete == "force") {
    message = `Yakin hapus data, data akan dihapus permanen dari sistem!`;
  }

  return new Promise((resolve, reject) => {
    konfirmasiSweet(message, "Ya, hapus!", "Tidak, batalkan").then(() => {
      ajaxMaster(src, "DELETE", sendData, false)
        .then((ress) => {
          alertSweet(
            ress.message,
            ress.success ? "success" : "error"
          ).then(() => {
            if (redirectLocation) {
              document.location.href = redirectLocation;
            }
            resolve(ress);
          });
        })
        .catch((error) => {
          handleError(error);
          reject(error);
        });
    });
  });
};

const actionModalData = (btn, titleButtonDone = "Simpan") => {
  let btnModal = $(btn);
  let buttonDone = false;

  if (btnModal.attr("btndetail") === undefined) {
    buttonDone = {
      title: titleButtonDone,
      autoClose: false,
      action: function () {
        $("#default-drsk-modal").find("form").submit();
      },
    };
  }

  openModalLG({
    title: btnModal.data("title"),
    src: btnModal.data("url"),
    buttonClose: {
      title: "Tutup",
      action: function () { },
    },
    buttonDone: buttonDone,
  });
};

const submitModalDataTable = (form) => {
  ajaxMasterSimpan(form, $(form).attr("action"), "POST")
    .then((ress) => {
      if (typeof DRSKMODAL == "object") DRSKMODAL.hide();
      reloadDataTable();
    })
    .catch((err) => {
      setInvalidFeedBack(err, form);
    });
};

const reloadDataTable = (table = DATATABLE_ID) => {
  return new Promise(() => {
    $(`#${table}`).DataTable().ajax.reload();
  });
};

const deleteDataDataTable = (url, sendData = {}, typeDelete = "soft") => {
  return new Promise((resolve, reject) => {
    ajaxHapusData(url, sendData, false, typeDelete)
      .then((success) => {
        reloadDataTable().then(() => {
          resolve(success);
        });
      })
      .catch((error) => {
        reject(error);
      });
  });
};

const openModal = (param, msize = "modal-lg") => {
  if (!param.src) {
    iziToast.error({
      title: "Oops..",
      message: "Alamat src tujuan tidak valid!",
      position: "topRight",
    });
    return false;
  }

  const modalDom = param.modalDom ?? "#default-drsk-modal";
  let modal = $(modalDom),
    buttonDone = modal.find("[btnModalDone]"),
    buttonClose = modal.find("[btnModalClose]");

  // set size modal
  modal.find("#modal-dialog").removeClass().addClass(`modal-dialog ${msize}`);

  // init modal
  DRSKMODAL = new bootstrap.Modal(modal[0]);

  param.buttonDone === false ? buttonDone.hide() : buttonDone.show();

  loaderPage(true);

  $.get(param.src)
    .done(function (out) {
      modal.find(".modal-title").html(param.title);
      modal.find("[btnModalClose]").html(param.buttonClose.title);
      modal.find("[btnModalDone]").html(param.buttonDone.title);
      modal.find(".modal-body").html(out);
      DRSKMODAL.show(); //show

      buttonClose.unbind("click").click(function () {
        if (typeof param.buttonClose != "undefined") {
          if (typeof param.buttonClose.action != "undefined") {
            param.buttonClose.action();
          }
        }

        modal.find(".modal-title").empty();
        modal.find("[btnModalClose]").empty();
        modal.find("[btnModalDone]").empty();
        modal.find(".modal-body").empty();

        $(this).unbind("click");
      });

      if (param.buttonDone !== false) {
        buttonDone.unbind("click").click(function () {
          param.buttonDone.action(modal);
          if (param.buttonDone.autoClose == false) {
          } else {
            buttonClose.click();
            $(this).unbind("click");
          }
        });
      }
    })
    .always(function () {
      loaderPage(false);
    })
    .fail(function (err) {
      handleError(err);
    });
};

const openModalSM = (param) => {
  openModal(param, "modal-sm");
};
const openModalMD = (param) => {
  openModal(param, "modal-md");
};
const openModalLG = (param) => {
  openModal(param, "modal-lg");
};
const openModalFS = (param) => {
  openModal(param, "modal-fullscreen");
};

const konfirmasiSweet = (
  message,
  confirmMessage = "Ya",
  cancelMessage = "Tidak",
  icon = "info"
) => {
  return new Promise((resolve, reject) => {
    swal({
      title: "Apakah anda yakin?",
      text: message,
      icon: icon,
      buttons: {
        cancel: {
          text: cancelMessage,
          value: null,
          className: 'btn btn-danger',
          visible: true
        },
        confirm: {
          text: confirmMessage,
          value: true,
          className: 'btn btn-primary'
        }
      },
    }).then((result) => {
      if (result != null) {
        resolve();
      } else {
        reject();
      }
    });
  });
};

const ajaxMaster = (
  url,
  method,
  data = {},
  beforeSend,
  withLoadingScreen = true
) => {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: method,
      url: url,
      dataType: "json",
      data: data,
      beforeSend: () => {
        if (withLoadingScreen) loaderPage(true);
        if (typeof beforeSend === "function") beforeSend();
      },
      success: function (response) {
        if (withLoadingScreen) loaderPage(false);

        setCsrf(response);
        resolve(response);
      },
      error: function (err) {
        loaderPage(false);
        reject(err);
      },
    });
  });
};

const slugify = (form, target) => {
  let title = $(form).val();
  let slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
  $(`#${target}`).val(slug);
}

const configUploadPreview = (id_input, id_preview) => {
  $.uploadPreview({
    input_field: `#${id_input}`, // Default: .image-upload
    preview_box: `#${id_preview}`, // Default: .image-preview
    label_field: "#image-label", // Default: .image-label
    label_default: "Choose File", // Default: Choose File
    label_selected: "Change File", // Default: Change File
    no_label: false, // Default: false
    success_callback: null // Default: null
  });
}

const configSimpleSummernote = (className) => {
  $(`.${className}`).summernote({
    height: 200,
    toolbar: [
      ['font', ['bold', 'italic', 'underline', 'clear']],
      ['strike', ['strikethrough']],
      ['para', ['paragraph']],
    ],
  });
}

// Fungsi untuk membatasi input hanya angka dengan jumlah digit maksimal
function initializeNumberOnlyInputs() {
  document.querySelectorAll('input[data-number-only]').forEach(function (input) {
    input.addEventListener('input', function (e) {
      let value = this.value.replace(/[^0-9]/g, '');
      let maxDigits = this.getAttribute('data-max-digits');

      if (maxDigits && value.length > maxDigits) {
        value = value.slice(0, maxDigits);
      }

      this.value = value;
    });

    input.addEventListener('keypress', function (e) {
      if (!/[0-9]/.test(e.key)) {
        e.preventDefault();
      }

      let maxDigits = this.getAttribute('data-max-digits');
      if (maxDigits && this.value.length >= maxDigits) {
        e.preventDefault();
      }
    });
  });
}

// Panggil fungsi ini ketika dokumen sudah siap
document.addEventListener('DOMContentLoaded', function () {
  initializeNumberOnlyInputs();
});

// Jika Anda menggunakan Ajax atau memuat konten dinamis, panggil fungsi ini setelah memuat konten
// Contoh: setelah memuat modal
document.addEventListener('shown.bs.modal', function () {
  initializeNumberOnlyInputs();
});

const submitModalReloadPage = (form) => {
  ajaxMasterSimpan(form, $(form).attr("action"), "POST")
    .then((ress) => {
      if (ress.success) {
        window.location.reload();
      }
    })
    .catch((err) => {
      setInvalidFeedBack(err, form);
    });
};

const deleteDataReloadPage = (url, sendData = {}, typeDelete = "soft") => {
  return new Promise((resolve, reject) => {
    ajaxHapusData(url, sendData, false, typeDelete)
      .then((success) => {
        if (success.success) {
          window.location.reload();
        }
      })
      .catch((error) => {
        reject(error);
      });
  });
};