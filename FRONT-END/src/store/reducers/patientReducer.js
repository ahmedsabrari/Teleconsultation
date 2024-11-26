// Logic to handle state changes for patients.

import { ADD_PATIENT, REMOVE_PATIENT } from '../actions/patientActions';

const initialState = {
    patients: [],
};

const patientReducer = (state = initialState, action) => {
    switch (action.type) {
        case ADD_PATIENT:
            return {
                ...state,
                patients: [...state.patients, action.payload],
            };
        case REMOVE_PATIENT:
            return {
                ...state,
                patients: state.patients.filter(pat => pat.id !== action.payload),
            };
        default:
            return state;
    }
};

export default patientReducer; 