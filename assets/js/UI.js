// menu
const menuToggle = document.querySelector('.menu-toggle');
const navMenu = document.getElementById('nav-menu');

// Lấy phần tử "Trang chủ"
const homeLink = navMenu.querySelector('li:first-child');

menuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('show');

    // Kiểm tra nếu menu đang hiển thị
    if (navMenu.classList.contains('show')) {
        homeLink.style.display = 'none'; // Ẩn "Trang chủ" khi mở menu
    } else {
        homeLink.style.display = 'block'; // Hiện "Trang chủ" khi đóng menu
    }
});


const navItems = navMenu.querySelectorAll('li a');
    navItems.forEach(item => {
    item.addEventListener('click', () => {
        navMenu.classList.remove('show'); // Đóng menu khi nhấn vào một mục
    });
});


// phan slides
let slideIndex = 0;
    showSlides();
    
    function showSlides() {
        let slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        slides[slideIndex-1].style.display = "block";  
        setTimeout(showSlides, 10000); // Change image every 10 seconds
    }
// phan khoa
document.addEventListener('DOMContentLoaded', function() {
    const departmentListItems = document.querySelectorAll('.department-list li');
    const departmentTitle = document.getElementById('department-title');
    const departmentDescription = document.getElementById('department-description');
    const departmentImage = document.getElementById('department-image');

    const departmentData = {
        '1': {
            title: 'Khoa Nội',
            description: 'Chuyên khám và điều trị các bệnh lý về nội khoa, bao gồm các bệnh về tim mạch, hô hấp, tiêu hóa, và thần kinh.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '2': {
            title: 'Khoa Nhi',
            description: 'Chăm sóc sức khỏe cho trẻ em từ sơ sinh đến 18 tuổi với đội ngũ bác sĩ nhi khoa tận tâm và chuyên nghiệp.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '3': {
            title: 'Khoa Sản',
            description: 'Cung cấp dịch vụ chăm sóc sức khỏe cho phụ nữ mang thai, sinh nở và các bệnh lý phụ khoa.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '4': {
            title: 'Khoa Da Liễu',
            description: 'Chuyên khám và điều trị các bệnh lý về da, tóc, móng và các bệnh lý lây qua đường tình dục.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '5': {
            title: 'Khoa Mắt',
            description: 'Chăm sóc và điều trị các bệnh lý về mắt, bao gồm khúc xạ, viêm, và các vấn đề về thị lực.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        },
        '6': {
            title: 'Khoa Tai Mũi Họng',
            description: 'Khám và điều trị các vấn đề liên quan đến tai, mũi, họng, và các bệnh lý về đường hô hấp trên.',
            image: 'https://images.pexels.com/photos/33109/fall-autumn-red-season.jpg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
        }
    };

    function updateDepartmentInfo(departmentId) {
        const data = departmentData[departmentId];
        departmentTitle.textContent = data.title;
        departmentDescription.textContent = data.description;
        departmentImage.src = data.image;
    }

    // Cập nhật thông tin khoa Nội khi trang được tải
    updateDepartmentInfo('1');

    departmentListItems.forEach(item => {
        item.addEventListener('click', function() {
            const departmentId = this.getAttribute('data-department');
            updateDepartmentInfo(departmentId);
        });
    });
});