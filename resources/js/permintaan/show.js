
let urlLimit = "/permintaan/getLimit";
let urlPermintaan = "/permintaan/getPermintaan";
let urlSimpan =  "/permintaan_store";
let data_limit = []
let grandtotal = null;
let today = new Date();
let year = today.getFullYear();
let month = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
let day = String(today.getDate()).padStart(2, '0');
let tanggal = `${year}-${month}-${day}`;
let data_permintaan = [];
let totalPermintaan = 0;
let limitUnit = 0;
let sudahPermintaan = 0;
let sisaSaldo = 0;

document.getElementById("btn-save").onclick = async () => {
    
    const { totalPermintaan, limitUnit, sudahPermintaan } = await cekLimit();
    const formattedTotalPermintaan = totalPermintaan.toLocaleString('id-ID');
    const formattedLimitUnit = limitUnit.toLocaleString('id-ID');
    const formattedSudahPermintaan = sudahPermintaan.toLocaleString('id-ID');
    const formattedSisaSaldo = (limitUnit - sudahPermintaan).toLocaleString('id-ID');

    console.log(formattedTotalPermintaan);
    console.log(formattedLimitUnit);
    console.log(formattedSudahPermintaan);

    if (totalPermintaan > limitUnit) {
        alert(
            `Permintaan melebihi limit Gudang Umum. Koordinasi dengan Manajer Unit ya!

            - Total Permintaan Kamu: ${formattedTotalPermintaan}
            - Limit Unit: ${formattedLimitUnit}
            - Sudah Permintaan: ${formattedSudahPermintaan}
            - Sisa Saldo Boleh Permintaan: ${formattedSisaSaldo}`
        );
        return
    }
    simpanKeDatabase();
    // throw new Error('Errorrrr sengaja');

};

async function simpanKeDatabase()
{
    try {
        // Ambil elemen form
        let form = document.querySelector('form');
        let formData = new FormData(form);

        let csrfMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfMeta) {
            console.error("CSRF token meta tag tidak ditemukan!");
            alert('CSRF token tidak ditemukan, periksa template HTML Anda!');
            return;
        }

        let csrfToken = csrfMeta.getAttribute('content');
        console.log("CSRF Token:", csrfToken);

        // Kirim data ke server menggunakan fetch
        let response = await fetch('/permintaan_store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        console.log("Status Response:", response.status);
        console.log("Response URL:", response.url);

        // Periksa respons dari server
        if (response.ok) {
            let result = await response.json();
            console.log('Data berhasil disimpan:', result);

            // Jika berhasil, bisa redirect atau tampilkan pesan sukses
            alert('Data berhasil disimpan!');
            window.location.href = '/permintaan'; // Redirect ke halaman permintaan
        } else {
            // Tangani error dari server
            let error = await response.json();
            console.error('Error dari server:', error);
            alert('Gagal menyimpan data: ' + error.message);
        }
    } catch (err) {
        // Tangani error dari sisi frontend
        console.error('Terjadi kesalahan:', err);
        console.error('Detail error:', err.response ? err.response.data : err.message);
        alert('Terjadi kesalahan saat menyimpan data.');
    }

}

async function cekLimit()
{
    let unit = document.getElementById("unit-nama").innerText; // Ambil teks dari label
    
    try{

        data_limit = await getLimit(unit); // MENGAMBIL DATA LIMIT
        limitUnit = data_limit[0].unit_limit;

        // MENGAMBIL DATA PERMINTAAN
        const grandTotalRow = Array.from(document.querySelectorAll('#tabel-permintaan tr')).find(row => 
            row.textContent.includes('GRAND TOTAL')
        );
        
        // Ambil nilai kolom terakhir (Grand Total)
        if (grandTotalRow) {
            const grandTotalValue = grandTotalRow.querySelector('td:last-child').textContent.trim();
            console.log('Grand Total:', grandTotalValue);
            grandtotal = grandTotalValue.substring(3, 20);
            grandtotal = Math.floor(grandtotal)
        }
        
    } catch (err) {
        console.error("Terjadi kesalahan pada limit: ", err.message);
    }

    // console.log("data Limit " + data_limit[0].unit_limit);
    // console.log('Grand Total:', grandtotal);
    // console.log(tanggal);

    // MENGAMBIL PERMINTAAN BULAN BERJALAN
    try {
        console.log(unit, tanggal);

        data_permintaan = await getPermintaan(unit, tanggal);
    } catch (err)
    {
        console.error("Terjadi kesalahan pada bulan berjalan: ", err.message);
    }
    console.log("dataPermintaan ", data_permintaan);
    for (let i = 0; i < data_permintaan.length; i++) {
        totalPermintaan += data_permintaan[i].permintaan_detail_jumlah * data_permintaan[i].permintaan_detail_harga;
    }
    console.log("Total Permintaan: ", totalPermintaan);
    sudahPermintaan = totalPermintaan;
    totalPermintaan += grandtotal;
    // console.log("Total Permintaan + Gramd: "totalPermintaan);

    // if(totalPermintaan > limitUnit)
    // {
    //     alert('Cieee ' + unit + ' Udah Kebanyakan Permintaan Gudang Umum, koordinasi sama Manajer Unit yaa...')
    //     return;
    // }
    
    // alert("Boleh Permintaan");
    return { totalPermintaan, limitUnit, sudahPermintaan };
}

async function getLimit(unit)
{
    console.log(unit);
    try {
        const res = await axios.get(urlLimit, 
            {params:
                {unit:unit}
            });
            console.log(res.data)
            console.log("Unit Limit " + res.data[0].unit_limit)
                
            return res.data;
            // if(res.data.length > 0)
            // {
            //     // throw new Error("Unit tidak ditemukan!");
            //     console.log("Unit Limit " + res.data[0].unit_limit)
                
            //     return res.data;
                
            // } else {
            //     alert("Unit: " + unit + " Tidak Ditemukan");
            //     return [];
            // }
    } catch (err){
        console.error("Error:", err.message);
        throw err;
    }
}

async function getPermintaan(unit, tanggal)
{
    try {
        const res = await axios.get(urlPermintaan, {
            params: { unit: unit, tanggal: tanggal }
        });
        console.log(res.data);
        console.log(res.data)
        return res.data;

        // if(res.data.length > 0)
        // {
        //     console.log(res.data)
        //     return res.data;
        // } else {
        //     alert("Permintaan: " + unit + " Tidak Ditemukan");
        //     return [];
        // }
    } catch (err){
        console.error("Error:", err.message);
        throw err;
    }
}

