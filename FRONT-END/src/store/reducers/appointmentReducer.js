// Logic to handle state changes for appointments.

import { ADD_APPOINTMENT, REMOVE_APPOINTMENT } from '../actions/appointmentActions';

const initialState = {
    appointments: [],
};

const appointmentReducer = (state = initialState, action) => {
    switch (action.type) {
        case ADD_APPOINTMENT:
            return {
                ...state,
                appointments: [...state.appointments, action.payload],
            };
        case REMOVE_APPOINTMENT:
            return {
                ...state,
                appointments: state.appointments.filter(app => app.id !== action.payload),
            };
        default:
            return state;
    }
};

export default appointmentReducer; 