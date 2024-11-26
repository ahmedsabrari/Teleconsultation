


const doctors = [];

export const addDoctor = (doctor) => {
    doctors.push(doctor);
    return doctor;
};

export const getDoctors = () => {
    return doctors;
};

export const updateDoctor = (id, updatedDoctor) => {
    const index = doctors.findIndex(doc => doc.id === id);
    if (index !== -1) {
        doctors[index] = { ...doctors[index], ...updatedDoctor };
        return doctors[index];
    }
    return null;
};

export const deleteDoctor = (id) => {
    const index = doctors.findIndex(doc => doc.id === id);
    if (index !== -1) {
        return doctors.splice(index, 1);
    }
    return null;
}; 