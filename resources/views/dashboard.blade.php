@extends('layouts.master')
@section('content')





<div class="row mb-3">

    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data AKun Sales</h6>
             
                <a class="m-0 float-right btn btn-danger btn-sm text-white" type="button" onclick="addnewss()">Tambah  <i class="fas fa-plus"></i></a>
             

            </div>
           
            <div class="table-responsive">
            
                <table class="table align-items-center table-flush " id="datass">
        
                        <thead class="thead-light">


                            <tr>
                                <th>No.</th>
                                <th>No. Induk Pegawai</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>

</div>




{{-- Modal --}}



<div class="modal fade" id="ModalTambahSS" tabindex="-1" aria-labelledby="ModalTambahSSLabel" aria-hidden="true">
<div id="loader" ></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambahSSLabel">Tambah Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="addss">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No Induk Pegawai</label>
                        <div class="col-sm-9">
                            <input type="text" id="no_induk_pegawai" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="text" id="password" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" id="email" class="form-control">
                        </div>
                    </div>


                   
                  
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tambahkanss">Tambahkan</button>
                <button type="button" aidi_ss="" class="btn btn-primary" id="editkanss">Update</button>
            </div>
        </div>
    </div>
</div>



{{-- Modal --}}



@endsection

@section('js')





<script>
    $(document).ready(function() {
        getslideshow()
    
    })

    $("#tambahkanss").click(() => {
             
      
        
        $("#addss input[type='text']").removeClass('is-invalid')
        $("#addss textarea").removeClass('is-invalid')
        var jmla = 0
        $("#addss input[type='text']").each((i, a) => {
            if ($(a).val() == "") {
                $(a).addClass('is-invalid')
                jmla++
            }
        })
        if ($("#addss textarea").val() == "") {
            $("#addss textarea").addClass('is-invalid')
        }
        if (jmla == 0 && $("#addss textarea").val() != "") {
            tambahss()
        }
    })

    $("#editkanss").click(() => {
        $("#adsspostingan input[type='text']").removeClass('is-invalid')
        $("#addss textarea").removeClass('is-invalid')
        var jmla = 0
        $("#addss input[type='text']").each((i, a) => {
            if ($(a).val() == "") {
                $(a).addClass('is-invalid')
                jmla++
            }
        })
        if ($("#addss textarea").val() == "") {
            $("#addss textarea").addClass('is-invalid')
        }
        if (jmla == 0 && $("#addss textarea").val() != "") {
            updatess($("#editkanss").attr("aidi_ss"))
        }
    })

    function addnewss() {
        $("#loader").addClass('d-none')
        $("#ModalTambahSSLabel").html("Tambah Informasi")
        $("#tambahkanss").removeClass('d-none')
        $("#editkanss").addClass('d-none')
        $('#ModalTambahSS').modal('show')
        $("#addss input[type='text']").val('')
        $("#addss textarea").val('')
        $('.upimageposting').removeClass('d-block').addClass('d-block').removeClass('d-none')
        $('#img-uploadposting').removeClass('d-none').addClass('d-none').removeClass('d-block')
    }

    async function getslideshow() {
        await axios.get("{{url('api/data-sales')}}")
            .then((res) => {
                $("#datass").DataTable().destroy()
                $("#datass tbody").empty()
           
               
                $no=1
                res.data.forEach((data) => {
                    $("#datass tbody").append(
                        ` <tr>
                        <td>` + ($no++) + `</td>
                        <td><a href="#">` + data.no_induk_pegawai + `</a></td>
                    
                        <td><a  class="btn text-white btn-sm btn-primary" onclick="editss(` + data.id + `)">        <i class="fas fa-edit  fex-2"></i> </a>
                        <a class="btn text-white btn-sm btn-danger" onclick="hapusss(` + data.id + `,'` + data.no_induk_pegawai + `')"> <i class="fas fa-trash fex-2 "></i></a>
                        </td>
                    </tr>
                `
                    )
                })
            })
        $("#datass ").DataTable()
    }

  
    async function tambahss() {
        var no_induk_pegawai = $("#no_induk_pegawai").val()
        var password = $("#password").val()
        var email = $("#email").val()
        file = $("#uploadimagefileposting")
    

        let data = new FormData();
   
        data.append('no_induk_pegawai', no_induk_pegawai)
        data.append('password', password)
        data.append('email', email)

        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };
        $('#loader').removeClass('d-none')
        await axios.post("{{url('api/add-sales')}}", data, config)
            .then((res) => {
                console.log(res)
                $('#ModalTambahSS').modal('hide')
                getslideshow()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Sales Telah ditambahkan'
                })
            })
            // $('.loader').addClass('d-none')
            console.log(res)
    }

    async function updatess(id) {
        var no_induk_pegawai = $("#no_induk_pegawai").val()
        var password = $("#password").val()
        var email = $("#email").val()
       

        let data = new FormData();
        data.append('no_induk_pegawai', no_induk_pegawai)
        data.append('password', password)
        data.append('email', email)
      
        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
        };
        $('#loader').removeClass('d-none')

        await axios.post("{{url('api/update-sales')}}" + "/" + id, data, config)
            .then((res) => {
                console.log(res)
                $('#ModalTambahSS').modal('hide')
                getslideshow()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Informasi Berhasil Diubah'
                })
            })
    }

    function hapusss(id, pemilik) {
        Swal.fire({
            title: 'Apakah Anda Menghapus  ' + pemilik + '?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Hapus`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                axios.delete("{{url('api/hapus-sales')}}" + "/" + id).then((res) => {
                    getslideshow()
                    Swal.fire('Akun Sales ' + pemilik + ' Berhasil Dihapus', '', 'success')
                })
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }

    async function editss(id) {
        $("#loader").addClass('d-none')
        $("#ModalTambahSSLabel").html("Update Informasi")
        $("#tambahkanss").addClass('d-none')
        $("#editkanss").removeClass('d-none')
        $("#editkanss").attr("aidi_ss", id)
        await axios.get("{{url('api/get-sales')}}" + "/" + id)

            .then((res) => {
                console.log(res.data.id)
                $('#ModalTambahSS').modal('show')
                $("#no_induk_pegawai").val(res.data.no_induk_pegawai)
                $("#email").val(res.data.email)
                $('.upimageposting').removeClass('d-none').addClass('d-none').removeClass('d-block')
                $('#img-uploadposting').removeClass('d-block').addClass('d-block').removeClass('d-none')
            })
    }

 
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.dataP').DataTable();
    });
</script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>



@endsection