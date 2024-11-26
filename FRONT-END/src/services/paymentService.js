// Purpose: Handle payment processing.

const payments = [];

export const processPayment = (payment) => {
    payments.push(payment);
    return payment;
};

export const getPayments = () => {
    return payments;
};

export const refundPayment = (id) => {
    const index = payments.findIndex(pay => pay.id === id);
    if (index !== -1) {
        const refundedPayment = { ...payments[index], refunded: true };
        payments[index] = refundedPayment;
        return refundedPayment;
    }
    return null;
}; 