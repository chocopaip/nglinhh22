function CsangF(C) {
    return (C * 9/5) + 32;
  }
  
  let nhietDoC = parseFloat(prompt("Nhập nhiệt độ (°C):"));
  let nhietDoF = CsangF(nhietDoC);
  console.log(nhietDoC + "°C là " + nhietDoF + "°F");