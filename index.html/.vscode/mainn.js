// Hàm tính diện tích hình chữ nhật
function tinhDienTichHinhChuNhat() {
    let chieuDai = parseFloat(prompt("Nhập chiều dài của hình chữ nhật:"));
    let chieuRong = parseFloat(prompt("Nhập chiều rộng của hình chữ nhật:"));

    if (isNaN(chieuDai) || isNaN(chieuRong)) {
      console.log("Vui lòng nhập đủ thông tin hợp lệ!");
    } else {
      let dienTich = chieuDai * chieuRong;
      console.log("Diện tích hình chữ nhật là: " + dienTich + " m²");
    }
  }

  // Hàm tính diện tích hình tam giác
  function tinhDienTichHinhTamGiac() {
    let canhDay = parseFloat(prompt("Nhập chiều dài cạnh đáy của hình tam giác:"));
    let chieuCao = parseFloat(prompt("Nhập chiều cao của hình tam giác:"));

    if (isNaN(canhDay) || isNaN(chieuCao)) {
      console.log("Vui lòng nhập đủ thông tin hợp lệ!");
    } else {
      let dienTich = (canhDay * chieuCao) / 2;
      console.log("Diện tích hình tam giác là: " + dienTich + " m²");
    }
  }

  // Hàm tính diện tích hình vuông
  function tinhDienTichHinhVuong() {
    let canh = parseFloat(prompt("Nhập độ dài cạnh của hình vuông:"));

    if (isNaN(canh)) {
      console.log("Vui lòng nhập đủ thông tin hợp lệ!");
    } else {
      let dienTich = canh * canh;
      console.log("Diện tích hình vuông là: " + dienTich + " m²");
    }
  }

  // Gọi các hàm để kiểm tra
  tinhDienTichHinhChuNhat();  // Tính diện tích hình chữ nhật
  tinhDienTichHinhTamGiac();   // Tính diện tích hình tam giác
  tinhDienTichHinhVuong();     // Tính diện tích hình vuông
