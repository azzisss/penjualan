

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});


// const currentDate = document.querySelector(".current-date");
// const daysTag = document.querySelector(".days");
// const prevNextIcon = document.querySelectorAll(".icon button");

// let date = new Date();
// currYear = date.getFullYear();
// currMonth = date.getMonth();

// const months = ['Januari', 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli'
// , 'Agustus' , 'September' , 'Oktober', 'November','Desember']; 

// const renderCalender = () => {
//     let fristDayofMonth = new Date(currYear, currMonth, 1).getDay(); //ambil hari awal dari bulan
//     let lastDateofMonth = new Date(currYear, currMonth + 1,0).getDate(); //ambil tanggal terakhir dari bulan
//     let lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(); //ambil hari terakhir dari bulan
//     let lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();//ambil tanggal terakhir dari bulan sebelumnya
//     let liTag = "";

//     for (let i = fristDayofMonth; i > 0; i--) {
//         liTag += "<li class='inactive'>"+(lastDateofLastMonth-i + 1) +"</li>";
        
//     }

//     for (let i = 1; i <= lastDateofMonth; i++) {
//         let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
//         liTag += `<li class=${isToday}>${i} <br>`+`</li>`;

//     }
//     for (let i = lastDayofMonth; i < 6; i++){
//         liTag += "<li class='inactive'>"+(i - lastDayofMonth + 1)+"</li>";
    
//     }
//     daysTag.innerHTML = liTag;
//     currentDate.innerText = `${months[currMonth]} ${currYear}`;
// }
// renderCalender();

// prevNextIcon.forEach(icon => {
//     icon.addEventListener("click", () =>{
        
//         currMonth =icon.id === "prev" ? currMonth - 1 : currMonth + 1;

//         if (currMonth < 0 || currMonth > 11) {
//             date = new Date(currYear, currMonth);
//             currYear = date.getFullYear();
//             currMonth = date.getMonth();
//         }else{
//             date = new Date();
//         }
//         renderCalender();
//     })
// })

