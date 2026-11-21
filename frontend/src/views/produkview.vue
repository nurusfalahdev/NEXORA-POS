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
                        <button class="btn-solid theme-warning">
                            <i class="bi bi-file-earmark-excel"></i>
                            Import Excel
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
                                            <input type="text" name="kode" id="kode" class="form-control">
                                        </div>
                                        <div class="nama col-md-6">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control">
                                        </div>
                                        <div class="ukuran col-md-6">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" name="ukuran" id="ukuran" class="form-control">
                                        </div>
                                        <div class="harga col-md-6">
                                            <label for="harga">Harga</label>
                                            <input type="text" name="harga" id="harga" class="form-control">
                                        </div>
                                    </div>
                                    <!-- satuan -->
                                    <div class="satuan">
                                        <label for="satuan">Satuan</label>
                                        <input type="text" name="satuan" id="satuan" class="form-control" value="Pcs">
                                    </div>
                                </form>
                            </div>
                            <div class="dialog-footer">
                                <button type="button" class="btn-solid theme-secondary"
                                    data-bs-dismiss="dialog">Close</button>
                                <button type="button" class="btn-solid theme-primary">Save changes</button>
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
                                <button type="button" class="btn-solid theme-primary" @click="saveEdit">Save
                                    changes</button>
                            </div>
                        </dialog>
                    </div>
                </div>

                <table class="table table-striped text-center table-hover">
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
            throw new Error(hasil.message || 'Gagal mengubah produk');
        }

        alert('data berhasil di perbaharui');
        await getproduk();
    } catch (error) {
        console.error(error);
        alert(error.message);
    }
}


</script>
