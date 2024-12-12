import { createSlice } from "@reduxjs/toolkit";
import {
  loginUser,
  registerUser,
  logoutUser,
  getUserProfile,
  updateUserProfile,
  resetPassword,
  changePassword,
  verifyEmail,
  manageRoleBasedAccess,
  deactivateAccount
} from "../services/authService";

const initialState = {
  user: null,
  token: null,
  loading: false,
  error: null,
  isAuthenticated: false,
  passwordResetStatus: null,
  emailVerificationStatus: null,
  roleBasedAccess: null,
};

const authSlice = createSlice( {
  name: "auth",
  initialState,
  reducers: {
    // Custom reducer for setting the user directly
    setUser1: ( state, action ) => {
      state.user = action.payload;
    },
    // Custom reducer for updating the user profile
    updateUser1: ( state, action ) => {
      if ( state.user ) {
        state.user = { ...state.user, ...action.payload };
      }
    },
    // Custom reducer for clearing authentication state (e.g., for logout)
    clearAuthState: ( state ) => {
      state.user = null;
      state.token = null;
      state.isAuthenticated = false;
      state.error = null;
    },
    // A reducer to manually set the user data
    setUser2: ( state, action ) => {
      state.user = action.payload;
      state.isAuthenticated = true;
    },
    // A reducer to clear user data
    clearUser: ( state ) => {
      state.user = null;
      state.token = null;
      state.isAuthenticated = false;
    },
    // A reducer to set authentication errors
    setAuthError: ( state, action ) => {
      state.error = action.payload;
    },
    // A reducer to update the user's profile data locally (sync)
    updateUser2: ( state, action ) => {
      state.user = { ...state.user, ...action.payload };
    },
  },
  extraReducers: ( builder ) => {
    builder
      // Login
      .addCase( loginUser.pending, ( state ) => {
        state.loading = true;
        state.error = null;
      } )
      .addCase( loginUser.fulfilled, ( state, action ) => {
        state.loading = false;
        state.user = action.payload.user;
        state.token = action.payload.token;
        state.isAuthenticated = true;
      } )
      .addCase( loginUser.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
        state.isAuthenticated = false;
      } )
      // Register
      .addCase( registerUser.pending, ( state ) => {
        state.loading = true;
        state.error = null;
      } )
      .addCase( registerUser.fulfilled, ( state, action ) => {
        state.loading = false;
        state.user = action.payload.user;
        state.token = action.payload.token;
        state.isAuthenticated = true;
      } )
      .addCase( registerUser.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
        state.isAuthenticated = false;
      } )
      // Logout
      .addCase( logoutUser.pending, ( state ) => {
        state.loading = true;
        state.error = null;
      } )
      .addCase( logoutUser.fulfilled, ( state ) => {
        state.loading = false;
        state.user = null;
        state.token = null;
        state.isAuthenticated = false;
      } )
      .addCase( logoutUser.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
        state.isAuthenticated = false;
      } )
      // Get User Profile
      .addCase( getUserProfile.pending, ( state ) => {
        state.loading = true;
        state.error = null;
      } )
      .addCase( getUserProfile.fulfilled, ( state, action ) => {
        state.loading = false;
        state.user = action.payload.user;
      } )
      .addCase( getUserProfile.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
      } )
      // Update User Profile
      .addCase( updateUserProfile.pending, ( state ) => {
        state.loading = true;
        state.error = null;
      } )
      .addCase( updateUserProfile.fulfilled, ( state, action ) => {
        state.loading = false;
        state.user = action.payload.user;
      } )
      .addCase( updateUserProfile.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
      } )
      // Password Reset
      .addCase( resetPassword.pending, ( state ) => {
        state.loading = true;
        state.error = null;
        state.passwordResetStatus = null;
      } )
      .addCase( resetPassword.fulfilled, ( state, action ) => {
        state.loading = false;
        state.passwordResetStatus = action.payload.status;
      } )
      .addCase( resetPassword.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
        state.passwordResetStatus = 'failed';
      } )
      // Change Password
      .addCase( changePassword.pending, ( state ) => {
        state.loading = true;
        state.error = null;
      } )
      .addCase( changePassword.fulfilled, ( state ) => {
        state.loading = false;
        state.passwordResetStatus = 'changed';
      } )
      .addCase( changePassword.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
        state.passwordResetStatus = 'failed';
      } )
      // Verify Email
      .addCase( verifyEmail.pending, ( state ) => {
        state.loading = true;
        state.error = null;
        state.emailVerificationStatus = null;
      } )
      .addCase( verifyEmail.fulfilled, ( state ) => {
        state.loading = false;
        state.emailVerificationStatus = 'verified';
      } )
      .addCase( verifyEmail.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
        state.emailVerificationStatus = 'failed';
      } )
      // Role-Based Access
      .addCase( manageRoleBasedAccess.pending, ( state ) => {
        state.loading = true;
        state.error = null;
        state.roleBasedAccess = null;
      } )
      .addCase( manageRoleBasedAccess.fulfilled, ( state, action ) => {
        state.loading = false;
        state.roleBasedAccess = action.payload.access;
      } )
      .addCase( manageRoleBasedAccess.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
        state.roleBasedAccess = 'denied';
      } )
      // Deactivate Account
      .addCase( deactivateAccount.pending, ( state ) => {
        state.loading = true;
        state.error = null;
      } )
      .addCase( deactivateAccount.fulfilled, ( state ) => {
        state.loading = false;
        state.user = null;
        state.token = null;
        state.isAuthenticated = false;
      } )
      .addCase( deactivateAccount.rejected, ( state, action ) => {
        state.loading = false;
        state.error = action.error.message;
      } );
  },
} );

export default authSlice.reducer;
export const { setUser1, updateUser1, clearAuthState, setUser2, clearUser, setAuthError, updateUser2 } = authSlice.actions;
export const selectAuth = ( state ) => state.auth;
