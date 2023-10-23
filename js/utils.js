//Validar por enteros positivos > 0
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

// Validar que sea un documento válido.
function isValidDni(dni) {
  const dniRegex = /^[0-9]{8}$/;
  return dniRegex.test(dni);
}

// Validar que sea un numero telefonico válido.
function isValidPhoneNumber(phone) {
  const phoneRegex = /^[0-9]{9}$/;
  return phoneRegex.test(phone);
}

// Validar que sea un numero de matricula válido.
function isValidLicenseNumber(license) {
  const licenseRegex = /^[0-9]{6}$/;
  return licenseRegex.test(license);
}

// Confirmar si desea cancelar la operación. Si es así, redirigir a la página indicada.
function handleCancelConfirmation(redirectTo = "/medicare") {
  const confirm = window.confirm(
    "¿Estas seguro que deseas cancelar? Los cambios no se guardaran"
  );

  if (confirm) {
    window.location.href = redirectTo;
  }
}
