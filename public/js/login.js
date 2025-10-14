// document.addEventListener('DOMContentLoaded', function () {
//     const loginForm = document.getElementById('loginForm');

//     if (!loginForm) return; // Prevent error if form not found

//     loginForm.addEventListener('submit', function (e) {
//         let valid = true;

//         const email = document.getElementById('email')?.value.trim();
//         const emailError = document.getElementById('emailError');
//         if (!email) {
//             emailError.textContent = "Email is required.";
//             emailError.classList.remove('hidden');
//             valid = false;
//         } else if (!/^\S+@\S+\.\S+$/.test(email)) {
//             emailError.textContent = "Please enter a valid email address.";
//             emailError.classList.remove('hidden');
//             valid = false;
//         } else {
//             emailError.textContent = "";
//             emailError.classList.add('hidden');
//         }

//         const password = document.getElementById('password')?.value.trim();
//         const passwordError = document.getElementById('passwordError');
//         if (!password) {
//             passwordError.textContent = "Password is required.";
//             passwordError.classList.remove('hidden');
//             valid = false;
//         } else if (password.length < 6) {
//             passwordError.textContent = "Password must be at least 6 characters.";
//             passwordError.classList.remove('hidden');
//             valid = false;
//         } else {
//             passwordError.textContent = "";
//             passwordError.classList.add('hidden');
//         }

//         if (!valid) {
//             e.preventDefault();
//         }
//     });
// });
