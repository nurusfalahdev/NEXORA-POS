    <template>
        <div class="container-fluid">
            <h2 class="fw-bold">Halaman Produk</h2>

            <p class="text-secondary">
                Daftar Semua Produk
            </p>

            <div class="content">
                <!-- fillter and button -->
                <div class="filter d-flex gap-2">
                    <div class="search">
                        <input type="text" class="form-control" placeholder="silahkan cari...." v-model="keyword">
                    </div>
                    <div class="button d-flex gap-2">
                        <button class="btn-solid theme-accent" data-bs-toggle="dialog" data-bs-target="#adddialog">
                            <i class="bi bi-plus-circle-fill"></i>
                            Add Data
                        </button>
                        <!-- import -->
                        <label for="fileExcel" class="btn-solid theme-warning">
                            <i class="bi bi-file-earmark-excel"></i>
                            Import Excel
                        </label>
                        <input type="file" id="fileExcel" accept=".xlsx,.xls,.csv" hidden @change="importExcel" />
                        <!-- export -->
                        <button type="button" class="btn-solid theme-secondary" @click="exportExcel">
                            <i class="bi bi-file-earmark-arrow-down"></i>
                            Export Excel
                        </button>
                    </div>
                </div>

                <!-- modal dialog -->
                <div class="dialog">
                    <div class="dialog-add">
                        <dialog class="dialog dialog-instant" id="adddialog">
                            <div class="dialog-header">
                                <h1 class="dialog-title">Input Product Name</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="dialog"
                                    aria-label="Close"></button>
                            </div>
                            <div class="dialog-body">
                                <form action="" method="post">
                                    <div class="input row grid grid-cols-2">
                                        <div class="kode col-md-6">
                                            <label for="kode">Kode</label>
                                            <input type="text" name="kode" id="kode" class="form-control"
                                                v-model="tambah.kode">
                                        </div>
                                        <div class="nama col-md-6">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                v-model="tambah.nama">
                                        </div>
                                        <div class="ukuran col-md-6">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" name="ukuran" id="ukuran" class="form-control"
                                                v-model="tambah.ukuran">
                                        </div>
                                        <div class="harga col-md-6">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="harga" id="harga" class="form-control"
                                                v-model="tambah.Harga">
                                        </div>
                                    </div>
                                    <!-- satuan -->
                                    <div class="satuan">
                                        <label for="satuan">Satuan</label>
                                        <input type="text" name="satuan" id="satuan" class="form-control" value="Pcs"
                                            v-model="tambah.satuan">
                                    </div>
                                </form>
                            </div>
                            <div class="dialog-footer">
                                <button type="button" class="btn-solid theme-secondary"
                                    data-bs-dismiss="dialog">Close</button>
                                <button type="button" class="btn-solid theme-primary" @click="addData">Save
                                    changes</button>
                            </div>
                        </dialog>
                    </div>
                    <!-- edit dialog -->
                    <div class="dialog-edit">
                        <dialog class="dialog dialog-slide-up" id="editdialog">
                            <div class="dialog-header">
                                <h1 class="dialog-title">Edit Data Product</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="dialog"
                                    aria-label="Close"></button>
                            </div>
                            <div class="dialog-body">
                                <form action="" method="post">
                                    <div class="input row grid grid-cols-2">
                                        <div class="kode col-md-6">
                                            <label for="kode">Kode</label>
                                            <input type="text" name="kode" id="kode" class="form-control"
                                                v-model="dataEdit.kode">
                                        </div>
                                        <div class="nama col-md-6">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                v-model="dataEdit.nama">
                                        </div>
                                        <div class="ukuran col-md-6">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" name="ukuran" id="ukuran" class="form-control"
                                                v-model="dataEdit.ukuran">
                                        </div>
                                        <div class="harga col-md-6">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="harga" id="harga" class="form-control"
                                                v-model="dataEdit.Harga">
                                        </div>
                                    </div>
                                    <!-- satuan -->
                                    <div class="satuan">
                                        <label for="satuan">Satuan</label>
                                        <input type="text" name="satuan" id="satuan" class="form-control" value="Pcs"
                                            v-model="dataEdit.satuan">
                                    </div>
                                </form>
                            </div>
                            <div class="dialog-footer">
                                <button type="button" class="btn-solid theme-secondary"
                                    data-bs-dismiss="dialog">Close</button>
                                <button type="button" class="btn-solid theme-danger" @click="destroyData(dataEdit.id)">
                                    <i class="bi bi-trash-fill"></i>
                                    Delete
                                </button>
                                <button type="button" class="btn-solid theme-primary" @click="saveEdit">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                            </div>
                        </dialog>
                    </div>
                </div>

                <table class="mt-5 table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(item, index) in dataPagination" :key="item.id">
                            <th scope="row">
                                {{ (currentPage - 1) * perPage + index + 1 }}
                            </th>
                            <td>{{ item.kode }}</td>
                            <td>{{ item.nama }}</td>
                            <td>{{ item.ukuran }}</td>
                            <td>Rp. {{ item.Harga }}</td>
                            <td>{{ item.satuan }}</td>
                            <td>
                                <button class="btn-solid theme-success" data-bs-toggle="dialog"
                                    data-bs-target="#editdialog" @click="edit(item)">
                                    <i class="bi bi-eye-fill"></i>
                                    Show
                                </button>
                            </td>
                        </tr>

                        <tr v-if="produk.length === 0">
                            <td colspan="7" class="text-center">
                                Data produk kosong
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-secondary">
                        Menampilkan
                        {{ (currentPage - 1) * perPage + 1 }}
                        sampai
                        {{ Math.min(currentPage * perPage, produk.length) }}
                        dari {{ produk.length }} data
                    </small>

                    <nav>
                        <ul class="pagination mb-0">

                            <!-- Previous -->
                            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                <button class="page-link" @click="changePage(currentPage - 1)">
                                    Previous
                                </button>
                            </li>

                            <!-- Nomor halaman -->
                            <li v-for="page in totalPages" :key="page" class="page-item"
                                :class="{ active: currentPage === page }">

                                <button class="page-link" @click="changePage(page)">
                                    {{ page }}
                                </button>
                            </li>

                            <!-- Next -->
                            <li class="page-item" :class="{ disabled: currentPage === totalPages }">

                                <button class="page-link" @click="changePage(currentPage + 1)">
                                    Next
                                </button>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </template>

<script setup>

import { ref, computed, onMounted, watch } from 'vue';
import Swal from 'sweetalert2';

const produk = ref([]);
const currentPage = ref(1);
const perPage = ref(7);
const keyword = ref('');


// Pencarian produk
const cari = computed(() => {
    return produk.value.filter((item) => {
        const pencarian = keyword.value.toLowerCase();

        return (
            String(item.kode).toLowerCase().includes(pencarian) ||
            String(item.nama).toLowerCase().includes(pencarian)
        );
    });
});

// Total halaman berdasarkan hasil pencarian
const totalPages = computed(() => {
    return Math.ceil(cari.value.length / perPage.value);
});

// Data pagination berdasarkan hasil pencarian
const dataPagination = computed(() => {
    const start = (currentPage.value - 1) * perPage.value;
    const end = start + perPage.value;

    return cari.value.slice(start, end);
});

// Reset halaman ketika pencarian berubah
watch(keyword, () => {
    currentPage.value = 1;
});

// Mengubah halaman
const changePage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
};

// Mengambil data produk
const getproduk = async () => {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/produk');

        if (!response.ok) {
            throw new Error('Gagal mengambil data');
        }

        const hasil = await response.json();
        produk.value = hasil.data;

    } catch (error) {
        console.error(error.message);
    }
};

onMounted(() => {
    getproduk();
});


const dataEdit = ref({
    id: null,
    kode: '',
    nama: '',
    ukuran: '',
    Harga: '',
    satuan: ''
});
const kodeAsli = ref('');
// edit data
function edit(item) {
    dataEdit.value = { ...item };
    kodeAsli.value = item.kode;
}

const saveEdit = async () => {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/produk/${dataEdit.value.id}`,
            {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(dataEdit.value)
            });

        const hasil = await response.json();
        console.log('Status:', response.status);
        console.log('Respons API:', hasil);

        if (!response.ok) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data Produk Gagal Edit.',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Produk Berhasil Edit.',
                timer: 2000,
                showConfirmButton: false
            });
        }

        await getproduk();

        const modal = document.getElementById('editdialog');
        if (modal.open) {
            modal.close();
        }
    } catch (error) {
        console.error(error);
        Swal.fire(error.message);
    }
}


const tambah = ref({
    kode: '',
    nama: '',
    ukuran: '',
    Harga: '',
    satuan: ''
})

const addData = async () => {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/produk', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(tambah.value)
        });
        const hasil = await response.json();

        if (!response.ok) {
            console.log('Error validasi:', hasil.errors);

            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                text: Object.values(hasil.errors || {})
                    .flat()
                    .join('\n') || hasil.message
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'success!',
                text: 'Data Produk Berhasil Di Add',
                timer: 2000,
                showConfirmButton: false
            });

            tambah.value = {
                kode: '',
                nama: '',
                ukuran: '',
                Harga: '',
                satuan: ''
            };

        }

        const modal = document.getElementById('adddialog');
        if (modal.open) {
            modal.close();
        }
        await getproduk();
    } catch (error) {
        console.error(error);
        alert(error.message)
    }
}


const destroyData = async (id) => {
    try {
        // Tutup modal Edit
        const modal = document.getElementById('editdialog');

        if (modal.open) {
            modal.close();
        }
        const konfirmasi = await Swal.fire({
            title: 'Hapus Produk?',
            text: 'Data produk yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });

        if (!konfirmasi.isConfirmed) {
            return;
        }
        //  req ke backend
        const response = await fetch(`http://127.0.0.1:8000/api/produk/${id}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json'
            }
        });

        const hasil = await response.json();

        if (!response.ok) {
            throw new Error(hasil.message || "gagal menghapus produk");
        }


        // Notifikasi berhasil
        await Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Produk berhasil dihapus.',
            timer: 2000,
            showConfirmButton: false
        });

        await getproduk();
        // Jika halaman sekarang kosong, kembali ke halaman sebelumnya
        if (dataPagination.value.length === 0 && currentPage.value > 1) {
            currentPage.value--;
        }
    } catch (error) {
        console.error(error);

        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: error.message
        });
    }
}


const importExcel = async (event) => {
    // Ambil file yang dipilih
    const file = event.target.files[0];

    if (!file) return;

    try {
        // Masukkan file ke FormData
        const formData = new FormData();
        formData.append('file', file);

        // Kirim ke Laravel
        const response = await fetch(
            'http://127.0.0.1:8000/api/produk/import',
            {
                method: 'POST',
                headers: {
                    'Accept': 'application/json'
                },
                body: formData
            }
        );

        const hasil = await response.json();

        if (!response.ok) {
            throw new Error(hasil.message || 'Import gagal!');
        }

        // Ambil ulang data produk
        await getproduk();

        // Notifikasi berhasil
        await Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: hasil.message
        });

    } catch (error) {
        console.error(error);

        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: error.message
        });

    } finally {
        // Reset input file
        event.target.value = '';
    }
};



const exportExcel = async () => {
    try {
        const response = await fetch(
            'http://127.0.0.1:8000/api/produk/export',
            {
                method: 'GET',
                headers: {
                    'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                }
            }
        );

        if (!response.ok) {
            throw new Error('Gagal mengunduh data produk!');
        }

        const blob = await response.blob();

        const url = window.URL.createObjectURL(blob);

        const link = document.createElement('a');
        link.href = url;
        link.download = 'data_produk_nexora.xlsx';

        document.body.appendChild(link);
        link.click();

        link.remove();
        window.URL.revokeObjectURL(url);

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data produk berhasil diexport.'
        });

    } catch (error) {
        console.error(error);

        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: error.message
        });
    }
};

</script>