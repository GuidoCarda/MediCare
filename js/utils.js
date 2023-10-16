function isValidQuantity(quantity) {
  const quantityRegex = /^[0-9]+$/;
  return quantityRegex.test(quantity);
}

// Validar que sea mayor de edad.
function isValidBirthdate(date) {
  const birthdate = new Date(date.replace(/-/g, "/"));
  const today = new Date();

  const diffInYears = Math.floor((today - birthdate) / MS_IN_YEAR);
  const difInMonths = today.getMonth() - birthdate.getMonth();

  if (diffInYears < 18) {
    return false;
  }

  if (diffInYears === 18 && difInMonths < 0) {
    return false;
  }

  if (
    diffInYears === 18 &&
    difInMonths === 0 &&
    birthdate.getDate() < today.getDate()
  ) {
    return false;
  }

  return true;
}

function isValidDni(dni) {
  const dniRegex = /^[0-9]{8}$/;
  return dniRegex.test(dni);
}
