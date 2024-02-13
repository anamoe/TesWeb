@extends('layouts.master')
@section('content')





<div class="row mb-3">

    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pakaet Penjualan</h6>
             
                <a class="m-0 float-right btn btn-danger btn-sm text-white" type="button" onclick="addnewss()">Tambah  <i class="fas fa-plus"></i></a>
             

            </div>
           
            <div class="table-responsive">
            
                <table class="table align-items-center table-flush " id="datass">
        
                        <thead class="thead-light">


                            <tr>
                                <th>No.</th>
                                <th>Nama Paket</th>
                                <th>Harga</th>
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
                        <label class="col-sm-3 col-form-label">Nama Paket</label>
                        <div class="col-sm-9">
                            <input type="text" id="nama_paket" class="form-control">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-9">
                            <input type="text" id="harga" class="form-control">
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
    }

    async function getslideshow() {
        await axios.get("{{url('api/data-paket')}}")
            .then((res) => {
                $("#datass").DataTable().destroy()
                $("#datass tbody").empty()
           
               
                $no=1
                res.data.forEach((data) => {
                    $("#datass tbody").append(
                        ` <tr>
                        <td>` + ($no++) + `</td>
                        <td><a href="#">` + data.nama_paket + `</a></td>
                        <td><a href="#">` + data.harga + `</a></td>
                        <td><a  class="btn text-white btn-sm btn-primary" onclick="editss(` + data.id + `)">        <i class="fas fa-edit  fex-2"></i> </a>
                        <a class="btn text-white btn-sm btn-danger" onclick="hapusss(` + data.id + `,'` + data.nama_paket + `')"> <i class="fas fa-trash fex-2 "></i></a>
                        </td>
                    </tr>
                `
                    )
                })
            })
        $("#datass ").DataTable()
    }

  
    async function tambahss() {
        var nama_paket = $("#nama_paket").val()
        var harga = $("#harga").val()

        let data = new FormData();
   
        data.append('nama_paket', nama_paket)
        data.append('harga', harga)

        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        };
        $('#loader').removeClass('d-none')
        await axios.post("{{url('api/add-paket')}}", data, config)
            .then((res) => {
                console.log(res)
                $('#ModalTambahSS').modal('hide')
                getslideshow()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Paket Telah ditambahkan'
                })
            })
            // $('.loader').addClass('d-none')
            console.log(res)
    }

    async function updatess(id) {
        var nama_paket = $("#nama_paket").val()
        var harga = $("#harga").val()
       

        let data = new FormData();
  
        data.append('nama_paket', nama_paket)
        data.append('harga', harga)
      
        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            },
        };
        $('#loader').removeClass('d-none')

        await axios.post("{{url('api/update-paket')}}" + "/" + id, data, config)
            .then((res) => {
                console.log(res)
                $('#ModalTambahSS').modal('hide')
                getslideshow()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data Paket Berhasil Diubah'
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
                axios.delete("{{url('api/hapus-paket')}}" + "/" + id).then((res) => {
                    getslideshow()
                    Swal.fire('Akun Paket ' + pemilik + ' Berhasil Dihapus', '', 'success')
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
        await axios.get("{{url('api/get-paket')}}" + "/" + id)

            .then((res) => {
                console.log(res.data.id)
                $('#ModalTambahSS').modal('show')
                $("#nama_paket").val(res.data.nama_paket)
                $("#harga").val(res.data.harga)
             
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