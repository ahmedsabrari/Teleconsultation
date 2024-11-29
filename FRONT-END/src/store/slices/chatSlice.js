import { createSlice } from '@reduxjs/toolkit';

const initialState = {
  messages: [],
  loading: false,
  error: null,
  activeChat: null,
};

const chatSlice = createSlice({
  name: 'chat',
  initialState,
  reducers: {
    setActiveChat: (state, action) => {
      state.activeChat = action.payload;
    },
    addMessage: (state, action) => {
      state.messages.push(action.payload);
    },
    setMessages: (state, action) => {
      state.messages = action.payload;
    },
    clearChat: (state) => {
      state.messages = [];
      state.activeChat = null;
    },
  },
});

export const {
  setActiveChat,
  addMessage,
  setMessages,
  clearChat,
} = chatSlice.actions;

export default chatSlice.reducer;