const MS_IN_YEAR = 1000 * 60 * 60 * 24 * 365;

//Validar por enteros positivos > 0
/**
 * @param {string} quantity Cantidad a validar
 * @returns {boolean} true si es valido, false si no lo es
 */
function isValidQuantity(quantity) {
  const quantityRegex = /^[0-9]+$/;
  return quantityRegex.test(quantity);
}

// Validar que sea mayor de edad.
/**
 * @param {string} date Fecha de nacimiento a validar
 * @returns {boolean} true si es valido, false si no lo es
 * @example
 * isValidBirthdate("2000-01-01") // true
 * isValidBirthdate("2010-01-01") // false
 * isValidBirthdate("2004-01-01") // false
 */
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
/**
 * @param {string} dni Documento a validar
 * @returns {boolean} true si es valido, false si no lo es
 */
function isValidDni(dni) {
  const dniRegex = /^[0-9]{8}$/;
  return dniRegex.test(dni);
}

// Validar que sea un numero telefonico válido.
/**
 * @param {string} phone Numero telefonico a validar
 * @returns {boolean} true si es valido, false si no lo es
 */
function isValidPhoneNumber(phone) {
  const phoneRegex = /^[0-9]{9}$/;
  return phoneRegex.test(phone);
}

// Validar que sea un numero de matricula válido.
/**
 * @param {string} license Numero de matricula a validar
 * @returns {boolean} true si es valido, false si no lo es
 */
function isValidLicenseNumber(license) {
  const licenseRegex = /^[0-9]{6}$/;
  return licenseRegex.test(license);
}

// Confirmar si desea cancelar la operación. Si es así, redirigir a la página indicada.
/**
 * @param {string} redirectTo Página a la que se redirigirá si se confirma la cancelación
 */
function handleCancelConfirmation(redirectTo = "/medicare") {
  const confirm = window.confirm(
    "¿Estas seguro que deseas cancelar? Los cambios no se guardaran"
  );

  if (confirm) {
    window.location.href = redirectTo;
  }
}

// Mostrar notificacion
/**
 * @param {string} message Mensaje a mostrar en la notificacion
 * @param {string} type Tipo de notificacion (success, error, warning)
 */
function toastNotification(message, type = "success") {
  const toast = document.getElementById("toast");

  if (toast.classList.contains("show")) return;

  toast.classList.add("show", type);
  toast.innerText = message;

  setTimeout(() => {
    toast.classList.remove("show", type);
  }, 3000);
}
