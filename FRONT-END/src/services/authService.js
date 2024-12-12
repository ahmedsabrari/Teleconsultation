// import { createAsyncThunk } from "@reduxjs/toolkit";
// import axios from "axios";

// // Base URL for API requests
// const API_BASE_URL = "http://127.0.0.1:8000/api";

// // Register a user (Patient, Doctor, or Administrator)
// export const registerUser = createAsyncThunk(
//   "auth/register",
//   async ({ userType, data }, { rejectWithValue }) => {
//     try {
//       const response = await axios.post(`${API_BASE_URL}/${userType}/register`, data);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Register Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Login a user (Patient, Doctor, or Administrator)
// export const loginUser = createAsyncThunk(
//   "auth/login",
//   async ({ userType, data }, { rejectWithValue }) => {
//     try {
//       const response = await axios.post(`${API_BASE_URL}/${userType}/login`, data);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Login Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Logout a user
// export const logoutUser = createAsyncThunk(
//   "auth/logout",
//   async (userType, { rejectWithValue }) => {
//     try {
//       const response = await axios.post(`${API_BASE_URL}/${userType}/logout`);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Logout Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Fetch user profile (Patient, Doctor, or Administrator)
// export const getUserProfile = createAsyncThunk(
//   "auth/getProfile",
//   async ({ userType, id }, { rejectWithValue }) => {
//     try {
//       const response = await axios.get(`${API_BASE_URL}/${userType}/${id}`);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Get Profile Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Update user profile (Patient, Doctor, or Administrator)
// export const updateUserProfile = createAsyncThunk(
//   "auth/updateProfile",
//   async ({ userType, id, data }, { rejectWithValue }) => {
//     try {
//       const response = await axios.put(`${API_BASE_URL}/${userType}/${id}`, data);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Update Profile Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Reset password (send reset email)
// export const resetPasswordRequest = createAsyncThunk(
//   "auth/resetPasswordRequest",
//   async ({ userType, email }, { rejectWithValue }) => {
//     try {
//       const response = await axios.post(`${API_BASE_URL}/${userType}/reset-password`, { email });
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Reset Password Request Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Reset password (update password with token)
// export const resetPassword = createAsyncThunk(
//   "auth/resetPassword",
//   async ({ userType, token, data }, { rejectWithValue }) => {
//     try {
//       const response = await axios.post(`${API_BASE_URL}/${userType}/reset-password/${token}`, data);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Reset Password Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Email verification
// export const verifyEmail = createAsyncThunk(
//   "auth/verifyEmail",
//   async ({ userType, token }, { rejectWithValue }) => {
//     try {
//       const response = await axios.post(`${API_BASE_URL}/${userType}/verify-email/${token}`);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Verify Email Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Fetch all users (Admin action)
// export const fetchAllUsers = createAsyncThunk(
//   "auth/fetchAllUsers",
//   async (userType, { rejectWithValue }) => {
//     try {
//       const response = await axios.get(`${API_BASE_URL}/${userType}`);
//       console.log("API Response:", response.data);
//       return response.data;
//     } catch (error) {
//       console.error("Fetch All Users Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );

// // Delete user (Admin action)
// export const deleteUser = createAsyncThunk(
//   "auth/deleteUser",
//   async ({ userType, id }, { rejectWithValue }) => {
//     try {
//       const response = await axios.delete(`${API_BASE_URL}/${userType}/${id}`);
//       console.log("API Response:", response.data);
//       return id; // Return the ID of the deleted user
//     } catch (error) {
//       console.error("Delete User Error:", error.response.data);
//       return rejectWithValue(error.response.data);
//     }
//   }
// );





import { createAsyncThunk } from "@reduxjs/toolkit";
import axios from "axios";

// Base URL for API requests
const API_BASE_URL = "http://127.0.0.1:8000/api";

// Register a user (General) - Function already present in the code
export const registerUser = createAsyncThunk(
  "auth/register",
  async ({ userType, data }, { rejectWithValue }) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/${userType}/register`, data);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Register Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Login a user (General) - Function already present in the code
export const loginUser = createAsyncThunk(
  "auth/login",
  async ({ userType, data }, { rejectWithValue }) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/${userType}/login`, data);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Login Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Logout a user - Function already present in the code
export const logoutUser = createAsyncThunk(
  "auth/logout",
  async (userType, { rejectWithValue }) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/${userType}/logout`);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Logout Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Password Reset (Forgot Password) - Function to send reset email
export const resetPasswordRequest = createAsyncThunk(
  "auth/resetPasswordRequest",
  async ({ userType, email }, { rejectWithValue }) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/${userType}/reset-password`, { email });
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Reset Password Request Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Change Password (update password with token)
export const resetPassword = createAsyncThunk(
  "auth/resetPassword",
  async ({ userType, token, data }, { rejectWithValue }) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/${userType}/reset-password/${token}`, data);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Reset Password Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Email Verification - Send and verify email
export const verifyEmail = createAsyncThunk(
  "auth/verifyEmail",
  async ({ userType, token }, { rejectWithValue }) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/${userType}/verify-email/${token}`);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Verify Email Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Role-Based Access Check - Check user’s role for access
export const checkRoleAccess = createAsyncThunk(
  "auth/checkRoleAccess",
  async ({ userType, data }, { rejectWithValue }) => {
    try {
      const response = await axios.post(`${API_BASE_URL}/${userType}/check-access`, data);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Role Access Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Admin: Manage User Roles (Promote/Demote Users)
export const manageUserRoles = createAsyncThunk(
  "auth/manageUserRoles",
  async ({ userType, userId, newRole }, { rejectWithValue }) => {
    try {
      const response = await axios.put(`${API_BASE_URL}/${userType}/${userId}/role`, { newRole });
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Manage User Roles Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Admin: Approve Doctor Registration
export const approveDoctorRegistration = createAsyncThunk(
  "auth/approveDoctor",
  async ({ userType, doctorId }, { rejectWithValue }) => {
    try {
      const response = await axios.put(`${API_BASE_URL}/${userType}/doctor/${doctorId}/approve`);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Approve Doctor Registration Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Admin: Suspend/Deactivate User Account
export const suspendUserAccount = createAsyncThunk(
  "auth/suspendUser",
  async ({ userType, userId }, { rejectWithValue }) => {
    try {
      const response = await axios.put(`${API_BASE_URL}/${userType}/${userId}/suspend`);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Suspend User Account Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);

// Admin: Audit Login History (View suspicious activities)
export const auditLoginHistory = createAsyncThunk(
  "auth/auditLoginHistory",
  async ({ userType, userId }, { rejectWithValue }) => {
    try {
      const response = await axios.get(`${API_BASE_URL}/${userType}/${userId}/login-history`);
      console.log("API Response:", response.data);
      return response.data;
    } catch (error) {
      console.error("Audit Login History Error:", error.response.data);
      return rejectWithValue(error.response.data);
    }
  }
);
