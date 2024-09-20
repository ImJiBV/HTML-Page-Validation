const today = new Date().toISOString().split('T')[0];
document.getElementById('birthDate').setAttribute('max', today);