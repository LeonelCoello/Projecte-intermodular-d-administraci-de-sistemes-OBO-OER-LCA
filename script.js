function yearsToMonths(years) {
  const parsedYears = Number(years);
  if (Number.isNaN(parsedYears)) {
    return 0;
  }
  return parsedYears * 12;
}

if (typeof module !== "undefined") {
  module.exports = { yearsToMonths };
}

if (typeof document !== "undefined") {
  const yearsInput = document.getElementById("years");
  const convertButton = document.getElementById("convertButton");
  const result = document.getElementById("result");

  convertButton?.addEventListener("click", () => {
    const months = yearsToMonths(yearsInput?.value ?? "");
    result.textContent = `${months} mesos`;
  });
}
