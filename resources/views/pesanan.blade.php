@section('data_sp')
<script>
  function toggleCustomMethod() {
      const select = document.getElementById('metode-pembayaran');
      const customMethod = document.getElementById('custom-method');
      const selectedValue = select.options[select.selectedIndex].value;
      if (selectedValue === 'lainnya') {
          customMethod.style.display = 'block';
          select.style.display = 'none';
      } else {
          customMethod.style.display = 'none';
          select.style.display = 'block';
      }
  }
</script>
<!-- Header : Start -->
<section class="section-py first-section-pt help-center-header position-relative overflow-hidden">
  <img class="banner-bg-img" src="{{ asset('sneat/assets/img/sima/header.png') }}" alt="Help center header">
  <h3 class="text-center"> Data Pesanan</h3>
  <h5 class="text-center px-3 mb-0">Pemantauan, pembuatan data pesanan</h5>
</section>
<!-- Header: End -->

  <!-- Data SP: Start -->
<!-- Manajemen Akun: Start -->
<section id="landingFunFacts">
  <!-- DataTable with Buttons -->
  <div class="row">
    <div class="col-xl-12">
      <div class="nav-align-top">
        <ul class="nav nav-tabs nav-fill" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-akun" aria-controls="navs-justified-akun" aria-selected="true">
              <i class="tf-icons bx bx-user"></i> Data Pesanan
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-generate" aria-controls="navs-justified-generate" aria-selected="false">
              <i class="tf-icons bx bxs-user-plus"></i> Generate Data Pesanan
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="navs-justified-akun" role="tabpanel">
            <div class="card-datatable table-responsive">
              <table id="accountTable" class="datatables-basic table border-top">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pesanan</th>
                    <th>PJ Rombongan</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Tujuan</th>
                    <th>Alamat Penjemputan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>AC30</td>
                    <td>johndoe</td>
                    <td>24 Juli 2024</td>
                    <td>Konoha Gakure</td>
                    <td>Tembalang</td>
                    <td>
                      <button class="btn btn-info btn-sm">View</button>
                      <button class="btn btn-warning btn-sm">Edit</button>
                      <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                  </tr>
                  <!-- Tambahkan data lain di sini -->
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-justified-generate" role="tabpanel">
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-body">
                  <form>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama Pemesan </label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
        
                          <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="JohnDoe" aria-label="JohnDoe" aria-describedby="basic-icon-default-fullname2" />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-icon-default-email">No Telp Pemesan</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <input type="text" id="" class="form-control" placeholder="083169251172" aria-label="083169251172" aria-describedby="2" />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-icon-default-role">PJ Rombongan</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <input type="datetime-local" id="departure-datetime" class="form-control" aria-describedby="departure-datetime-icon" />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="basic-icon-default-phone">No Telp PJ</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="departure-datetime">Tanggal Waktu Keberangkatan</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <input type="datetime-local" id="departure-datetime" class="form-control" aria-describedby="departure-datetime-icon" />
                        </div>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="return-datetime">Tanggal Waktu Kepulangan</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <input type="datetime-local" id="return-datetime" class="form-control" aria-describedby="return-datetime-icon" />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="pickup-address">Alamat Penjemputan</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <span id="pickup-address-icon" class="input-group-text"><i class="bx bx-map"></i></span>
                          <input type="text" id="pickup-address" class="form-control" placeholder="Masukkan alamat penjemputan" aria-describedby="pickup-address-icon" />
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="jumlah-armada">Jumlah Armada</label>
                      <div class="col-sm-10">
                        <input type="number" id="jumlah-armada" class="form-control" placeholder="Masukkan jumlah armada" aria-label="Jumlah Armada" />
                      </div>
                    </div>
                  
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="nilai-kontrak-1">Nilai Kontrak 1</label>
                      <div class="col-sm-10">
                        <input type="text" id="nilai-kontrak-1" class="form-control" placeholder="Masukkan nilai kontrak 1" aria-label="Nilai Kontrak 1" />
                      </div>
                    </div>
                  
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="nilai-kontrak-2">Nilai Kontrak 2</label>
                      <div class="col-sm-10">
                        <input type="text" id="nilai-kontrak-2" class="form-control" placeholder="Masukkan nilai kontrak 2" aria-label="Nilai Kontrak 2" />
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="biaya-tambahan">Biaya Tambahan</label>
                      <div class="col-sm-10">
                        <input type="text" id="biaya-tambahan" class="form-control" placeholder="Masukkan biaya tambahan" aria-label="Biaya Tambahan" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="total-biaya">Total Biaya</label>
                      <div class="col-sm-10">
                        <input type="text" id="total-biaya" class="form-control" placeholder="Masukkan total biaya" aria-label="Total Biaya" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="uang-muka">Uang Muka</label>
                      <div class="col-sm-10">
                        <input type="text" id="uang-muka" class="form-control" placeholder="Masukkan uang muka" aria-label="Uang Muka" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="sisa-pembayaran">Sisa Pembayaran</label>
                      <div class="col-sm-10">
                        <input type="text" id="sisa-pembayaran" class="form-control" placeholder="Sisa pembayaran" aria-label="Sisa Pembayaran" readonly />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="metode-pembayaran">Metode Pembayaran</label>
                      <div class="col-sm-10">
                        <select  class="form-select"  id="metode-pembayaran" onchange="toggleCustomMethod()">
                          <option value="cash">Cash</option>
                          <option value="tf">TF</option>
                          <option value="debit">Debit</option>
                          <option value="lainnya">Lainnya</option>
                      </select>
                      <input type="text" id="custom-method" class="form-control" style="display: none;"  placeholder="Masukkan metode pembayaran lainnya">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="catatan">Catatan</label>
                      <div class="col-sm-10">
                        <textarea type="text" id="catatan" class="form-control" placeholder="Masukkan catatan" aria-label="catatan" /></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="km-berangkat">KM saat berangkat</label>
                      <div class="col-sm-10">
                        <input type="text" id="km-berangkat" class="form-control" placeholder="Masukkan KM saat berangkat" aria-label="KM saat berangkat" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="km-saat-tiba">KM saat tiba</label>
                      <div class="col-sm-10">
                        <input type="text" id="km-tiba" class="form-control" placeholder="Masukkan KM saat tiba" aria-label="KM saat tiba" />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="kasbon-bbm">Kasbon BBM</label>
                      <div class="col-sm-10">
                        <input type="text" id="kasbon-bbm" class="form-control" placeholder="Kasbon BBM" aria-label="Kasbon BBM"/>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="kasbon-makan">Kasbon dan uang makan</label>
                      <div class="col-sm-10">
                        <input type="text" id="kasbon-makan" class="form-control" placeholder="Kasbon Makan" aria-label="Kasbon Makan"/>
                      </div>
                    </div>
                      <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="lain-lain">Lain-lain</label>
                        <div class="col-sm-10">
                          <input type="text" id="lain-lain" class="form-control" placeholder="Lain-lain" aria-label="Lain-lain"/>
                        </div>
                      </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="no-lambung">No Lambung</label>
                      <div class="col-sm-10">
                        <input type="text" id="no-lambung" class="form-control" placeholder="no-lambung" aria-label="no-lambung"/>
                      </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="driver">Driver</label>
                        <div class="col-sm-10">
                          <input type="text" id="driver" class="form-control" placeholder="driver" aria-label="driver"/>
                        </div>
                     </div>
                     <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="co-driver">Co Driver</label>
                      <div class="col-sm-10">
                        <input type="text" id="co-driver" class="form-control" placeholder="co-driver" aria-label="co-driver"/>
                      </div>
                    </div>

                  </div>


                    

                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- Data SP: End -->

<!-- Help Area: Start -->
<section class="section-py bg-body">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 text-center">
        <h3>Terdapat Kendala?</h3>
        <p class="mb-3"> Hubungi jika terdapat kendala dalam sistem ini.<br /> Hubungi kami selama jam kerja atau kirim email kapan saja, dan kami akan merespon secepat mungkin. </p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
          <a href="javascript:void(0);" class="btn btn-primary">Email</a>
          <a href="javascript:void(0);" class="btn btn-primary">Whats App</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Help Area: End -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const departureInput = document.getElementById('departure-datetime');
    const returnInput = document.getElementById('return-datetime');

    // Set min attribute for departure date to ensure past dates and times can't be selected
    const now = new Date();
    const formattedDateTime = now.toISOString().slice(0, 16); // Get current date and time in the format required by datetime-local input
    departureInput.setAttribute('min', formattedDateTime);

    // Automatically show the calendar when input is focused
    departureInput.addEventListener('focus', function () {
      departureInput.showPicker();
    });

    returnInput.addEventListener('focus', function () {
      returnInput.showPicker();
    });

    // Update return date min attribute based on departure date selection
    departureInput.addEventListener('input', function () {
      const selectedDepartureDateTime = new Date(departureInput.value);
      if (selectedDepartureDateTime < now) {
        alert('Tanggal dan waktu keberangkatan tidak boleh kurang dari hari ini');
        departureInput.value = ''; // Reset the input
      } else {
        // Set the min attribute of the return date input to be the same as the selected departure date and time
        returnInput.setAttribute('min', departureInput.value);
      }
    });

    // Custom validation for return date
    returnInput.addEventListener('input', function () {
      const selectedReturnDateTime = new Date(returnInput.value);
      const selectedDepartureDateTime = new Date(departureInput.value);
      if (selectedReturnDateTime < selectedDepartureDateTime) {
        alert('Tanggal dan waktu kepulangan tidak boleh kurang dari tanggal dan waktu keberangkatan');
        returnInput.value = ''; // Reset the input
      }
    });
  });
  
</script>
<script>
  function formatRupiah(angka, prefix) {
    let numberString = angka.replace(/[^,\d]/g, '').toString();
    let split = numberString.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
  }

  function parseRupiah(rupiah) {
    return parseInt(rupiah.replace(/[^0-9]/g, ''));
  }

  function updateSisaPembayaran() {
    let totalBiaya = parseRupiah(document.getElementById('total-biaya').value || '0');
    let uangMuka = parseRupiah(document.getElementById('uang-muka').value || '0');
    let sisaPembayaran = totalBiaya - uangMuka;
    document.getElementById('sisa-pembayaran').value = formatRupiah(sisaPembayaran.toString(), 'Rp ');
  }

  document.querySelectorAll('input[type="text"]').forEach(function (input) {
    input.addEventListener('input', function (e) {
      if (e.target.id !== 'sisa-pembayaran') {
        e.target.value = formatRupiah(e.target.value, 'Rp ');
      }
      if (e.target.id === 'total-biaya' || e.target.id === 'uang-muka') {
        updateSisaPembayaran();
      }
    });
  });
</script>


@endsection

@include('main_owner')