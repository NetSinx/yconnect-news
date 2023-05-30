// hamburger menu effect
const hamburger = document.querySelector('.hamburger');
const sidebar = document.querySelector('#sidebar');
const dashboard = document.querySelector('#dashboard');

document.onreadystatechange = () => {
  if ( window.innerWidth <= 850 ) {
    sidebar.classList.add('inactive-phone');
    dashboard.classList.add('inactive-phone');
    sidebar.classList.remove('active');
    dashboard.classList.remove('active');
  } else {
    sidebar.classList.add('active');
    dashboard.classList.add('active');
    sidebar.classList.remove('inactive-phone');
    dashboard.classList.remove('inactive-phone');
  }
}

hamburger.addEventListener('click', () => {
  if ( window.innerWidth <= 850 ) {
    sidebar.classList.remove('active');
    dashboard.classList.remove('active');
    hamburger.classList.toggle('is-active');
    sidebar.classList.toggle('active-phone');
    dashboard.classList.toggle('active-phone');
  } else {
    hamburger.classList.add('is-active');
    sidebar.classList.remove('inactive-phone');
    // sidebar.classList.remove('inactive');
    dashboard.classList.remove('inactive-phone');
    // dashboard.classList.remove('inactive');
    hamburger.classList.toggle('is-active');
    sidebar.classList.toggle('active');
    dashboard.classList.toggle('active');
  }
});

document.addEventListener('click', (e) => {
  if ( !hamburger.contains(e.target) && !sidebar.contains(e.target) ) {
    hamburger.classList.remove('is-active');
    sidebar.classList.remove('active-phone');
    dashboard.classList.remove('active-phone');
  }
});

function customValidationInput(text) {
  if (text.value === '') {
    text.setCustomValidity('Kolom ini wajib diisi!');
  } else if (text.validity.typeMismatch) {
    text.setCustomValidity("Format pengisian email harus menggunakan '@' dan nama domain!");
  } else {
    text.setCustomValidity('');
  }

  return true;
}

function readImage() {
  const image = document.getElementById('image');
  const imgPreview = document.querySelector('.imgPreview');
  const reader = new FileReader();
  
  if (image.files[0]) {
    console.log(reader.readAsDataURL(image.files[0]));
    reader.onload = (event) => {
      if (event) {
        imgPreview.src = event.target.result;
        imgPreview.classList.add('d-block');
      };
    }
  } else {
    imgPreview.src = '';
    imgPreview.classList.remove('d-block');
  };
}

// Sidebar link asynchronous
const dashboardLink = document.querySelectorAll("a[href='#dashboard']");
const postsLink = document.querySelectorAll("a[href='#posts']");
const categoryLink = document.querySelectorAll("a[href='#categories']");
const getDashboard = document.getElementById('dashboard');


for (let i = 0; i < dashboardLink.length; i++) {
  dashboardLink[i].addEventListener('click', (event) => {
    event.preventDefault();

    categoryLink[0].classList.remove('active');
    postsLink[0].classList.remove('active');
    dashboardLink[0].classList.add('active');
  
    asyncDashboard();
  });
}

for (let i = 0; i < postsLink.length; i++) {
  postsLink[i].addEventListener('click', (event) => {
    event.preventDefault();

    dashboardLink[0].classList.remove('active');
    categoryLink[0].classList.remove('active');
    postsLink[0].classList.add('active');
  
    asyncPosts();
  });
}

for (let i = 0; i < categoryLink.length; i++) {
  categoryLink[i].addEventListener('click', (event) => {
    event.preventDefault();

    dashboardLink[0].classList.remove('active');
    postsLink[0].classList.remove('active');
    categoryLink[0].classList.add('active');
  
    asyncCategories();
  });
}

async function asyncDashboard() {
  await fetch("/dashboard/klndfoighdfg3th34thifgjdfkjgdnjb32irk")
  .then(response => {
    if( !response.ok ) {
      getDashboard.innerHTML = "<h1 class='text-center'>Halaman tidak ditemukan!</h1>";
    } else {
      return response.text();
    }
  })
  .then(dataHtml => {
    getDashboard.innerHTML = '';
    getDashboard.innerHTML = dataHtml;
  })
  .catch(err => console.log(err));
}

async function asyncPosts() {
  await fetch("/dashboard/hjkdsfhkj4353459874hfjk")
  .then(response => {
    if( !response.ok ) {
      getDashboard.innerHTML = "<h1 class='text-center'>Halaman tidak ditemukan!</h1>";
    } else {
      return response.text();
    }
  })
  .then(dataHtml => {
    getDashboard.innerHTML = '';
    getDashboard.innerHTML = dataHtml;
  })
  .catch(err => console.log(err));
}

async function asyncCategories() {
  await fetch("/dashboard/lkjgdfyhgiu43893489gjdfgdfgfkgf")
  .then(response => {
    if( !response.ok ) {
      getDashboard.innerHTML = "<h1 class='text-center'>Halaman tidak ditemukan!</h1>";
    } else {
      return response.text();
    }
  })
  .then(dataHtml => {
    getDashboard.innerHTML = '';
    getDashboard.innerHTML = dataHtml;
  })
  .catch(err => console.log(err));
}