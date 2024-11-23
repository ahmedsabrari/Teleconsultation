import { ADD_DOCTOR, REMOVE_DOCTOR } from '../actions/doctorActions';

const initialState = {
    doctors: [],
};

const doctorReducer = (state = initialState, action) => {
    switch (action.type) {
        case ADD_DOCTOR:
            return {
                ...state,
                doctors: [...state.doctors, action.payload],
            };
        case REMOVE_DOCTOR:
            return {
                ...state,
                doctors: state.doctors.filter(doc => doc.id !== action.payload),
            };
        default:
            return state;
    }
};

export default doctorReducer; 