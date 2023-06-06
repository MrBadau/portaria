function carregarEmDiv(Param) {
  $.ajax({
    url: Param,

    success: function (container_fluid) {
      $(".container_fluid").html(container_fluid);
    },

    error: function () {
      $(".container_fluid").html("Erro");
    },
  });
}

function refreshContent() {
  $("#regEntradas").load("regEntradas.php");
}

function submitFormPost(actionUrl) {
  var form = $("#form");
  $.ajax({
    type: "POST",
    url: actionUrl,
    data: form.serialize(), // serializes the form's elements.
    success: function (data) {
      refreshContent();
      resetForm();
    },
  });
}

function submitFormOcorrencia(actionUrl, idStatus) {
  var form = $("#form");

  var dados = form.serialize();
  dados = dados + "&idStatus=" + idStatus;

  $.ajax({
    type: "POST",
    url: actionUrl,
    data: dados,
    success: function (data) {
      //console.log(dados);
      //alert(dados);
    },
  });
  return false;
}

function submitForm(actionUrl, ID) {
  $.ajax({
    type: "POST",
    url: actionUrl,
    data: {
      ID: ID,
    }, //
  });
  if (ID > 0) {
    $("#tr" + ID).remove();
    $("#modal").modal("hide");
  }
}

function submitFormUsuario(actionUrl, ID) {
  $.ajax({
    type: "POST",
    url: actionUrl,
    data: {
      ID: ID,
    }, //
  });
  if (ID > 0) {
    //$("#tr" + ID).remove();
    $("#modal").modal("hide");
    location.reload();
  }
}

function removeForm() {
  if ($("#entrou").val() == 1) {
    $("#veiculo").css("display", "block");
    $("#placa").css("display", "block");
  } else if ($("#entrou").val() == 2) {
    $("#veiculo").css("display", "none");
    $("#placa").css("display", "none");
  }
}

function resetForm() {
  $("#nome").val("");
  $("#documento").val("");
  $("#empresa").val("");
  $("#tipo").val("");
  $("#morador").val("");
  $("#pessoas").val("");
  $("#veiculo").val("");
  $("#placa").val("");
  $("#descricao").val("");
}

// function submitPost() {
//   const formEl = document.getElementById("form");

//   formEl.addEventListener("submit", (evento) => {
//     evento.preventDefault();

//     const formData = new FormData(formEl);
//     const data = Object.fromEntries(formData);
//     console.log(data);
//   });
// }
