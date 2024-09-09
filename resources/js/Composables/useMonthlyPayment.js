import { computed, unref } from 'vue'

export const useMonthlyPayment = (total, interestRate, duration) => {
    // Убираем дублирующиеся проверки на ref с помощью unref
    const monthlyPayment = computed(() => {
        const principle = unref(total)
        const monthlyInterest = unref(interestRate) / 100 / 12
        const numberOfPaymentMonths = unref(duration) * 12

        // Стандартная формула расчёта ежемесячного платежа по кредиту
        return (
            principle * monthlyInterest * Math.pow(1 + monthlyInterest, numberOfPaymentMonths)
        ) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
    })

    // Общая сумма выплат
    const totalPaid = computed(() => unref(duration) * 12 * monthlyPayment.value)

    // Общая сумма процентов
    const totalInterest = computed(() => totalPaid.value - unref(total))

    return { monthlyPayment, totalPaid, totalInterest }
}
