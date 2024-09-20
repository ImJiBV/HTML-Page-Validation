function calculateAge() {
    const birthDate = new Date(document.getElementById('birthDate').value);
    const today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    
    const monthDifference = today.getMonth() - birthDate.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    document.getElementById('age').value = age;
    const ageField = document.getElementById('age');
    validator.validateFields(ageField); 
}