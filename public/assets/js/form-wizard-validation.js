"use strict";
! function () {
    const e = $(".select2"),
        a = $(".selectpicker"),
        i = document.querySelector("#wizard-validation");
    if (i, null !== i) {
        const t = i.querySelector("#wizard-validation-form"),
            o = t.querySelector("#data-diri-validation");
        var m = t.querySelector("#penilaian-validation");
        const n = [].slice.call(t.querySelectorAll(".btn-next")),
            r = [].slice.call(t.querySelectorAll(".btn-prev")),
            s = new Stepper(i, {
                linear: !0
            }),
            l = FormValidation.formValidation(o, {
                fields: {
                    formValidationNamaPenilai: {
                        validators: {
                            notEmpty: {
                                message: "This field is required"
                            },
                        }
                    },
                    formValidationNamaPegawai: {
                        validators: {
                            notEmpty: {
                                message: "This field is required"
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6"
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus,
                    submitButton: new FormValidation.plugins.SubmitButton
                },
                init: e => {
                    e.on("plugins.message.placed", function (e) {
                        e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement)
                    })
                }
            }).on("core.form.valid", function () {
                s.next()
            }),
            d = FormValidation.formValidation(m, {
                fields: {
                    formValidationFirstName: {
                        validators: {
                            notEmpty: {
                                message: "The first name is required"
                            }
                        }
                    },
                    formValidationLastName: {
                        validators: {
                            notEmpty: {
                                message: "The last name is required"
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: ".col-sm-6"
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus,
                    submitButton: new FormValidation.plugins.SubmitButton
                }
            }).on("core.form.valid", function () {
              let penugasan_id = $('#penugasan_id').val();
              let pegawai_id = $('#formValidationNamaPegawai').val();
              let penilai_id = $('#formValidationNamaPenilai').val();
              let etika = $('input[name="etika"]:checked').val();
              let disiplin = $('input[name="disiplin"]:checked').val();
              let tanggung_jawab = $('input[name="tanggung_jawab"]:checked').val();
              let teamwork = $('input[name="teamwork"]:checked').val();
              let problem_solve = $('input[name="problemsolve"]:checked').val();
              let kepatuhan = $('input[name="kepatuhan"]:checked').val();
              let kejujuran = $('input[name="kejujuran"]:checked').val();
              let inisiatif = $('input[name="inisiatif"]:checked').val();
              let komunikasi = $('input[name="komunikasi"]:checked').val();
              let perencanaan = $('input[name="perencanaan"]:checked').val();
              let kepemimpinan = $('input[name="kepemimpinan"]:checked').val();
              let inovasi = $('input[name="inovasi"]:checked').val();
              let analisa_pemikiran = $('input[name="analisapemikiran"]:checked').val();

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
      
              $.ajax({
                url: "/penilaian",
                type:"POST",
                data:{
                  penugasan_id: penugasan_id, 
                  pegawai_id: pegawai_id, 
                  penilai_id: penilai_id,
                  etika: etika,
                  disiplin: disiplin,
                  tanggung_jawab: tanggung_jawab,
                  teamwork: teamwork,
                  problem_solve: problem_solve,
                  kepatuhan: kepatuhan,
                  kejujuran: kejujuran,
                  inisiatif: inisiatif,
                  komunikasi: komunikasi,
                  perencanaan: perencanaan,
                  kepemimpinan: kepemimpinan,
                  inovasi: inovasi,
                  analisa_pemikiran: analisa_pemikiran,
                },
                success:function(response){
                  if (response) {
                    alert('Berhasil disimpan!')
                    window.location.href = '/penilaian-success';
                  }
                },
               });
            });
        n.forEach(e => {
            e.addEventListener("click", e => {
                switch (s._currentIndex) {
                    case 0:
                        l.validate();
                        break;
                    case 1:
                        d.validate();
                        break;
                    case 2:
                        c.validate()
                }
            })
        }), r.forEach(e => {
            e.addEventListener("click", e => {
                switch (s._currentIndex) {
                    case 2:
                    case 1:
                        s.previous()
                }
            })
        })
    }
}();
