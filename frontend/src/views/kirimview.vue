<template>
    <div class="container">
        <h2 class="fw-bold">Halaman Invoice</h2>
        <p>Buat invoice anda dengan benar</p>

        <div class="content">
            <!-- button and filter -->
            <div class="button-filter d-flex gap gap-2">
                <div class="cari">
                    <input type="text" placeholder="Carii...." class="form-control">
                </div>

                <div class="filter">
                    <select name="" id="" class="form-control">
                        <option value="">Urutkan</option>
                    </select>
                </div>
                <div class="add">
                    <button class="btn-solid theme-primary">Add Invoice New</button>
                </div>
                <div class="reset">
                    <button class="btn-solid theme-secondary" type="reset">Reset</button>
                </div>
            </div>
            <!-- table inv -->
            <div class="mt-5">
                <h3>Daftar Invoice</h3>

                <div class="table-inv">
                    <table class="table table-striped table-bordered text-center table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">No Nota</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Customer/toko</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data,index) in nota" :key="data.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ data.no_nota }}</td>
                                <td>{{ data.tanggal }}</td>
                                <td>{{ data.customer }}</td>
                                <td>{{ data.jenis }}</td>
                                <td>{{ data.keterangan }}</td>
                                <td>{{ data.total }}</td>

                                <td>
                                    <button class="btn-solid theme-success">Show</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, computed } from "vue";

const nota = ref([]);

const getnota = async () => {
    try {
        const response = await fetch('http://localhost:8000/api/kirim')
        if (!response.ok) {
            throw new Error('gagal mengambil data');
        }
        const hasil = await response.json();
        nota.value = hasil.data;
    } catch (error) {
        console.error(error.message);
    }

    onMounted(() => {
        getnota();
    });
}
</script>