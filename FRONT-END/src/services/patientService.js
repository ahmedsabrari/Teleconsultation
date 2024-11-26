// Purpose: Manage patient-related data.

const patients = [];

export const addPatient = (patient) => {
    patients.push(patient);
    return patient;
};

export const getPatients = () => {
    return patients;
};

export const updatePatient = (id, updatedPatient) => {
    const index = patients.findIndex(pat => pat.id === id);
    if (index !== -1) {
        patients[index] = { ...patients[index], ...updatedPatient };
        return patients[index];
    }
    return null;
};

export const deletePatient = (id) => {
    const index = patients.findIndex(pat => pat.id === id);
    if (index !== -1) {
        return patients.splice(index, 1);
    }
    return null;
}; 