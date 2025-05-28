import pandas as pd

# Load the CSV data
df = pd.read_csv('GIS PPU-SSU Kedah.csv')

# Step 1: Remove rows where Voltage is empty AND Name does NOT contain "33kv"
voltage_empty = df['Voltage'].isna() | (df['Voltage'].str.strip() == '')
name_has_33kv = df['Name'].str.contains('33kv', case=False, na=False)

# Delete rows where Voltage is empty AND Name lacks "33kv"
df = df[~(voltage_empty & ~name_has_33kv)]

# Step 2: Keep rows where either:
# - Voltage contains "33" (case-insensitive), or
# - Name contains "33kv" (case-insensitive)
voltage_condition = df['Voltage'].fillna('').str.contains(r'(?i)33', na=False)
name_condition = df['Name'].str.contains(r'(?i)33kv', na=False)

df_filtered = df[voltage_condition | name_condition]

# Save the processed data
df_filtered.to_csv('processed_PPUSSU.csv', index=False)